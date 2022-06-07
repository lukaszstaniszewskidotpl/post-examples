vcl 4.1;

backend default {
    .host = "nginx";
    .port = "80";

    .probe = {
        .url = "/health";
        .timeout = 3s;
        .interval = 10s;
        .window = 5;
        .threshold = 3;
    }
}
