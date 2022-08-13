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

sub vcl_recv {
    set req.url = regsuball(req.url, "(gclid|fbclid|utm_[a-zA-Z0-9]+)=[%.-_A-z0-9]+&?", "");

    if (req.url ~ "(\?|&)live=0de080c_[a-zA-Z0-9]{1,}+&?") {
        set req.url = regsuball(req.url, "(\?|&)live=0de080c_[a-zA-Z0-9]{1,}+&?", "");

        return (pipe);
    }

    if (req.url ~ "^[^?]*\.(css|js|png|svg|webp)(\?.*)?$") {
        set req.http.X-Static-File = "true";
        unset req.http.Cookie;

        return(hash);
    }

    if (req.http.Cookie) {
        return (hash);
    }
}

sub vcl_hash {
  if (req.http.cookie ~ "user_group=") {
    set req.http.USER-GROUP = regsub(req.http.cookie, "^.*?user_group=([^;]+);*.*$", "\1");

    if (req.http.USER-GROUP ~ "^(DELTA|BETA|ALPHA)$") {
        hash_data(req.http.USER-GROUP);
    }

    unset req.http.USER-GROUP;
  }
}

sub vcl_backend_response {
     if (bereq.http.X-Static-File == "true") {
        set beresp.ttl = 60s;
     }
}
