import subprocess
import os
import sys
#----------------------------
# declaring variables 
#-----------------------------
list = "List of SystemCtl Processess"
checkdir = "Checking pusher directory"
reloaddaemon = "Reloading daemon"
enable_pusher = "Enabling pusher"
start_pusher  = "Starting pusher"
status_pusher = "Pusher status"
pusher_dir = "/var/www/html/pusher_docker";
process_contents = "[Unit]\nDescription=pusher docker\n[Service]\nExecStart=/usr/bin/docker docker-compose -f /var/www/html/pusher_docker/docker-compose.yml up\nType=simple\nRestart=always\n[Install]\nWantedBy=multi-user.target"

#----------------------------
# start of general process 
#---------------------------
print("Lets Play Some Clay")
##subprocess.check_call(["echo",list])
##subprocess.check_call(["systemctl", "list-units", "--type=service", "--state=running"])
subprocess.check_call(["echo",checkdir])
if os.path.isdir(pusher_dir):
	print("Writing Service")
	systemctl = open("/etc/systemd/system/local-pusher.service","w")
	systemctl.write(process_contents)
	systemctl.close()
	subprocess.check_call(["echo",reloaddaemon])
	subprocess.check_call(["systemctl","daemon-reload"])
	subprocess.check_call(["echo",enable_pusher])
	subprocess.check_call(["systemctl","enable","local-pusher"])
	subprocess.check_call(["echo",start_pusher])
	subprocess.check_call(["systemctl","start","local-pusher"])
	subprocess.check_call(["echo",status_pusher])
	subprocess.check_call("systemctl","status","local-pusher")
else:
	print("No service found. Aborting commands.")
sys.exit()
