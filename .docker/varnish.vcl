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

acl purge {
    "localhost";
    "fpm";
}

sub vcl_recv {
    if (req.method == "PURGE") {
        if (!client.ip ~ purge) {
            return(synth(405,"Not allowed."));
        }

        return (purge);
    }

    if (req.method == "BAN") {
        if (!client.ip ~ purge) {
            return (synth(405));
        }

        if (!req.http.X-Purge-Regex) {
            return (purge);
        }

        ban("req.http.host == " + req.http.host + " && req.url ~ " + req.http.X-Purge-Regex);

        return(synth(200, "Ban added"));
    }
}
