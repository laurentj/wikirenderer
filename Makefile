
ifndef WIKIRENDERER_SITE_TARGET
    WIKIRENDERER_SITE_TARGET=_site
endif

ifndef WIKIRENDERER_DNL_TARGET
    WIKIRENDERER_DNL_TARGET=_dnl/
endif

VERSION=$(shell cat VERSION)
FILES=lib/ composer.json CHANGELOG CREDITS LICENCE README.md VERSION example

ifeq (,$(findstring -,$(VERSION)))
    SUBDIR=
else
    SUBDIR=dev/
endif

_dist :
	@mkdir -p _dist _site

_dist/BUILDINFOS : _dist
	@echo "FILE=wikirenderer-"$(VERSION)".zip" > _dist/BUILDINFOS
	@echo "SUBDIR="$(SUBDIR) >> _dist/BUILDINFOS

_dist/wikirenderer-$(VERSION):
	@mkdir -p $@

_dist/wikirenderer-$(VERSION).zip : _dist/wikirenderer-$(VERSION)
	@cp -a $(FILES) _dist/wikirenderer-$(VERSION)/
	@(cd _dist && zip -r wikirenderer-$(VERSION).zip wikirenderer-$(VERSION)/)

.PHONY: build
build: clean _dist/wikirenderer-$(VERSION).zip _dist/BUILDINFOS

.PHONY: clean
clean:
	@rm -rf _dist/ _site/

vendor:
	@composer install

.PHONY: tests
tests: vendor
	cd tests/ && ../vendor/bin/phpunit

.PHONY: deploysite
deploysite:
	#rsync -av --delete --exclude=/wikirenderer/ website/ $(WIKIRENDERER_SITE_TARGET)
	#rsync -av --delete src/ $(WIKIRENDERER_SITE_TARGET)/wikirenderer/

.PHONY: deploypackage
deploypackage: build
	rsync -av _dist/wikirenderer-$(VERSION).zip $(WIKIRENDERER_DNL_TARGET)$(SUBDIR)
