FROM composer:1.10.22 as build

ARG branch=master
ARG repository=git@gitlab.lanhanba.com:location/locationServer.git
ARG repositoryName=locationServer

RUN mkdir /root/.ssh/
ADD id_rsa /root/.ssh/id_rsa
RUN chmod 600 /root/.ssh/id_rsa
RUN touch /root/.ssh/known_hosts
RUN ssh-keyscan gitlab.lanhanba.com >> /root/.ssh/known_hosts

WORKDIR /var/www
RUN git clone -b ${branch} ${repository}
WORKDIR /var/www/${repositoryName}
RUN cp .env.unit_test .env && ls -la && composer install --prefer-dist --no-scripts --no-dev -q -o --ignore-platform-reqs

FROM php:7.4

RUN apt-get update

#libmagickwand-dev:imagick
RUN apt-get install -qq libmagickwand-dev

# Install imagick extension
RUN pecl install imagick && docker-php-ext-enable imagick

COPY --from=build /var/www/${repositoryName} /var/www/
RUN chown -R root:root /var/www
