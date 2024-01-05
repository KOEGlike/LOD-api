# Use the official PHP image with Apache
FROM php:8.3

# Install the PHP extensions we need
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo_mysql pdo zip\
    && apt install nginx\
    && systemctl enable nginx


# Copy the application code to the container
COPY ./src ./src \ nginx.conf /etc/nginx/conf.d/

RUN docker-php-ext-install pdo
VOLUME /var/lib/mysql

# Expose port 80 for Apache
EXPOSE 80

# Use the official MySQL image
FROM mysql:latest

# Set the root password and database name
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=app

# Copy the database model to the container
COPY model.sql /docker-entrypoint-initdb.d

# Expose port 3306 for MySQL
EXPOSE 3306

CMD ["nginx", "-g", "daemon off;"]
