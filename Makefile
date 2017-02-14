all:
	@echo "Please choose a task."

lint:
	composer validate
	find . -name '*.yml' -not -path './vendor/*' -not -path './src/Resources/public/vendor/*' | xargs yaml-lint
	find . \( -name '*.xml' -or -name '*.xliff' \) \
		-not -path './vendor/*' -not -path './src/Resources/public/vendor/*' -type f \
		-exec xmllint --encode UTF-8 --output '{}' --format '{}' \;
	git diff --exit-code

test:

docs:
	cd src/Resources/doc && sphinx-build -W -b html -d _build/doctrees . _build/html
