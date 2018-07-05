# OpenCart Plugin

The OpenCart plugin that uses the GloBee Payment API.

## How to install on your website

Please check the [Plugin Page](https://globee.com/opencart) for instructions on how to install the plugin on your
OpenCart website.

### Server requirements
PHP > 5.5 with the following PHP plugins enabled:
* OpenSSL
* GMP or BCMATH
* JSON
* CURL

## How to make development changes

Clone the repo:
```bash
$ git clone https://github.com/globee-official/opencart-payment-api-plugin
$ cd opencart-payment-api-plugin
```

Install the dependencies:
```bash
$ composer install
```

After changes, build the distribution zip:
```bash
$ ./bin/robo build
```

The built plugin archive is available at `./dist/globee-opencart-3.0.2.ocmod.zip - the distribution archive`

## Versions
Tested on OpenCart v3.0.2

## License
This software is open-sourced software licensed under the [GNU General Public Licence version 3](https://www.gnu.org/licenses/) or later
