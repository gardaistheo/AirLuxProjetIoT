start_service() {
    echo "Starting microservice..."
        
    # Vérifie que Supervisor est actif
   sudo systemctl start supervisor 
   if [ $? -eq 0 ]; then 
        echo "Supervisor is started."
        
    else 
        echo "Failed to  don't start Supervisor."
        
    fi
    sudo systemctl start nginx
      if [ $? -eq 0 ]; then 
        echo "nginx is started."
        
    else 
        echo "nginx Failed ."
        
    fi

    
    
    # Démarre le microservice
    #supervisorctl start nom_du_microservice || { echo "Failed to start microservice"; return 1; }

    echo "Microservice started successfully."
}

start_service





HOST="hub.bzctoons.net"
USER="register"
API_REGISTER_ENDPOINT="http://$HOST/api/register"
MAC=$(cat /sys/class/net/eth0/address)

# read locals ports from config file
# LOCAL_PORTS=$(cat /etc/airnet/ports)
LOCAL_PORTS="22,80,443,8327"

echo "Local ports: $LOCAL_PORTS"
# create an array of ports
IFS=',' read -ra LOCAL_PORTS <<< "$LOCAL_PORTS"

# Get ports from API with the user agent and the mac address
# REMOTE_PORTS=$(curl -X POST -d "mac=$MAC&ports=$LOCAL_PORTS" -A "AirNet/1.0" $API_REGISTER_ENDPOINT)

echo "Getting ports from API: $API_REGISTER_ENDPOINT, mac=$MAC, ports=$LOCAL_PORTS"
REMOTE_PORTS=8022,8080,8443,18327
echo "Remote ports: $REMOTE_PORTS"
# create an array of ports
IFS=',' read -ra REMOTE_PORTS <<< "$REMOTE_PORTS"

# Loop over each port and create a reverse SSH tunnel from the raspberry to the server
for i in "${!LOCAL_PORTS[@]}"; do
    LOCAL_PORT=${LOCAL_PORTS[$i]}
    REMOTE_PORT=${REMOTE_PORTS[$i]}
    echo "Checking if port $LOCAL_PORT is used"
    if lsof -Pi :$LOCAL_PORT -sTCP:LISTEN -t >/dev/null ; then
        echo "Local port $LOCAL_PORT is used"
        echo "Creating reverse SSH tunnel for port $LOCAL_PORT to $REMOTE_PORT"
        autossh -M 0 -f -N -o "ServerAliveInterval 30" -o "ServerAliveCountMax 3" -R $REMOTE_PORT:localhost:$LOCAL_PORT $USER@$HOST
    fi
done
