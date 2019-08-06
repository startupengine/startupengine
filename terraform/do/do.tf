variable "do_token" {}

provider "digitalocean" {
    token = "${var.do_token}"
}

resource "digitalocean_droplet" "web" {
    name  = "tf-startup-engine"
    image = "ubuntu-18-04-x64"
    region = "nyc1"
    size   = "512mb"
}

output "ip" {
    value = "${digitalocean_droplet.web.ipv4_address}"
}

output "price_monthly" {
    value = "${digitalocean_droplet.web.price_monthly}"
}

output "metadata" {
    value = "${digitalocean_droplet.web}"
}