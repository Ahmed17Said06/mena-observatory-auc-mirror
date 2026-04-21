#!/bin/bash

# Log start of renewal attempt
echo "$(date): Starting SSL renewal process" >> /var/log/ssl-renewal.log

# Change to your project directory
cd /home/mabdelrazek/changes/mena-observatory

# Stop containers to free port 80
docker-compose down

# Attempt renewal (only renews if certificate expires within 30 days)
certbot renew --standalone --quiet

# Check if renewal was successful
if [ $? -eq 0 ]; then
    # Copy certificates
    cp /etc/letsencrypt/live/menaobservatory.ai/fullchain.pem ./docker/nginx/ssl/fullchain.crt
    cp /etc/letsencrypt/live/menaobservatory.ai/privkey.pem ./docker/nginx/ssl/private.key
    chown mabdelrazek:mabdelrazek ./docker/nginx/ssl/*
    
    # Rebuild nginx with new certificates
    docker-compose build nginx
    
    echo "$(date): SSL renewal process completed successfully" >> /var/log/ssl-renewal.log
else
    echo "$(date): SSL renewal failed" >> /var/log/ssl-renewal.log
fi

# Start containers back up
docker-compose up -d

echo "$(date): Containers restarted" >> /var/log/ssl-renewal.log
