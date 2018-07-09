# OpenCart Plugin

The OpenCart plugin that uses the GloBee Payment API.

Support for OpenCart Version 2.1 - 3.0

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

The built plugin archives are available in the `./dist/` directory

## Versions

Please see the list below to ensure you download the correct distribution for your version of OpenCart

Use `globee-opencart-3.0.2.ocmod.zip` for:
- OpenCart v3.0
- OpenCart v2.3

Use `globee-opencart-2.2.0.ocmod.zip` for:
- OpenCart v2.2

Use `globee-opencart-2.1.0.ocmod.zip` for:
- OpenCart v2.1


## License
This software is open-sourced software licensed under the [GNU General Public Licence version 3](https://www.gnu.org/licenses/) or later
