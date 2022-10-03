# Build pretty PDF CV using HTML and styling

This script will help you easily create and support your CV. Just use your photo and spend a time to collect the data about your experience in JSON file only once. Next time you need just actualize your data and build new CV.

You can customize existing template or create your own. It uses Twig template engine. All data stored in JSON are passed to template as variables.

### How to use

If you have Docker, use next commands:

    docker build -t cv-image .
    
    docker run -it --rm --name cv-builder -v "$PWD":/var/www/html cv-image php generate.php [OPTIONS]

where possible [OPTIONS] could be next:
1. `--data=resources/your-data.json` to use your own JSON file 
2. `--output=result/your-file.pdf` what output file should be in result
3. `--template=template/your-template.html.twig` if you want to specify your own Twig template

Without any options script will generate demo CV. You can try it to ensure everything works correct before work on your own. Demo result should look like this:

![Demo CV](resources/demo-result.jpg?raw=true)

