FROM node:12
WORKDIR /usr/src/app
COPY package*.json ./

RUN npm install
# RUN npm ci --only=production
COPY . .
EXPOSE 8080
EXPOSE 3000
CMD [ "node", "app.js" ]