FROM docker-registry.default.svc:5000/dev/drupalbase
RUN git clone https://tbankar7:Tissot%4076890@github.com/BeamSuntoryInc/basilhaydensdrupal.git /code
COPY settings.php /code/application/sites/default/settings.php
RUN cd /code && rm -rf .git && composer install