FROM ubuntu:latest

# Install Termux dan dependensi
RUN apt update && apt install -y curl tar xz-utils

# Install NoVNC
RUN apt install -y novnc websockify

# Expose port 8080
EXPOSE 8080

CMD ["novnc", "--listen", "8080"]
