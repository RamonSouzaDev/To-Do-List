FROM node:14

# set your user name, ex: user=bernardo
ARG user=ramon
ARG uid=1000

RUN npm install -g @vue/cli@5.0.8

WORKDIR /usr/src/app

COPY package*.json ./
RUN npm install

COPY . .

CMD ["npm", "run", "serve"]
