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
}
