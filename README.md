# CEP Searcher Application

## Installation

On console, go to the folder that you want to install
### Manual
```bash
git clone git@github.com:jorgejr568/cep-binarysearch.git #Cloning project
cd cep-binarysearch/ #Entering on directory
unzip -d ./app/data ./app/data/cep.zip #Unziping cep data file
```

### Script
```bash
wget https://raw.githubusercontent.com/jorgejr568/cep-binarysearch/master/install.sh -o ./install.sh 
sh install.sh
```

### Serving (Optional)

On application root, paste this on console
```bash
php -S 0.0.0.0:8888 &
```