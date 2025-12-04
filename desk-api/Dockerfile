FROM python:3.10-slim

RUN apt-get update && apt-get install -y git && apt-get clean

WORKDIR /app

RUN git clone https://source.coderefinery.org/sdm-edu/wifi2ble-box-simulator.git .

RUN pip install --upgrade pip

CMD ["python", "simulator/main.py", "--port", "8443", "--https", "--certfile", "config/cert.pem", "--keyfile", "config/key.pem"]



