# CEP Searcher Application

## Installation

On console, go to the folder that you want to install
### Manual
```bash
git clone git@github.com:jorgejr568/cep-binarysearch.git 
# CLONING PROJECT

cd cep-binarysearch/ 
# ENTERING ON DIRECTORY

unzip -d ./app/data ./app/data/cep.zip
# UNZIPING DAT FILES

cd ../..
# GOING BACK TO PROJECT ROOT
```

### Script
```bash
wget https://raw.githubusercontent.com/jorgejr568/cep-binarysearch/master/install.sh -O ./install.sh
# GETTING INSTALL SCRIPT

sh install.sh
# RUNNING INSTALL SCRIPT

cd cep-binarysearch 
# ENTERING ON PROJECT DIRECTORY 
```

### Serving (Optional)

On application root, paste this on console
```bash
php -S 0.0.0.0:8888 &
# SERVING APPLICATION ON 0.0.0.0:8888
```

## Run

### Console
```bash
php run.php [CEP]
```
- Replace \[CEP\] with the cep you want to check (Numbers-only)

### Browser

- Access http://your-server/run.php?cep=[CEP]
- Replace \[CEP\] with the cep you want to check
- Replace your-server with your local host or PHP built in server ([Previous step](#serving-optional))
