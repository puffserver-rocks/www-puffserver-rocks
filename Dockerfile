FROM docker.io/nginx:mainline-alpine-slim

COPY --chown=nginx:nginx ./wwwroot /usr/share/nginx/html
