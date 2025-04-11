FROM nginx:alpine

COPY ./docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx/ssl /etc/nginx/ssl