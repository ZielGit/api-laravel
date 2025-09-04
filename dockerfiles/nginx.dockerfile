FROM nginx:stable-alpine

# Eliminar configuración por defecto
RUN rm /etc/nginx/conf.d/default.conf

# Copiar configuración personalizada
COPY nginx/default.conf /etc/nginx/conf.d/

# Crear directorio y configurar permisos
RUN mkdir -p /var/www/html/public \
    && chown -R nginx:nginx /var/www/html

# Exponer puerto
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=30s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1
