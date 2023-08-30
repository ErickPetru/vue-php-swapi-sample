FROM node:18-alpine

ENV APP_DIR /var/www/html

RUN mkdir -p $APP_DIR
WORKDIR $APP_DIR
EXPOSE 80
VOLUME $APP_DIR

# Install dependencies
COPY package*.json .
RUN npm i

# Run the app
COPY . .
CMD ["npm", "run", "dev", "--", "--port", "80", "--logLevel", "silent"]
