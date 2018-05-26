# File structure organization algorithms

## Installation

On console, go to the folder that you want to install
### Manual
```bash
git clone git@github.com:jorgejr568/file-structure-organization-algorithms.git 
# CLONING PROJECT

cd file-structure-organization-algorithms/ 
# ENTERING ON DIRECTORY

unzip -d ./app/data ./app/data/cep.zip
# UNZIPING DAT FILES

cd ../..
# GOING BACK TO PROJECT ROOT
```

### Script
```bash
wget https://raw.githubusercontent.com/jorgejr568/file-structure-organization-algorithms/master/install.sh -O ./install.sh
# GETTING INSTALL SCRIPT

sh install.sh
# RUNNING INSTALL SCRIPT

cd file-structure-organization-algorithms 
# ENTERING ON PROJECT DIRECTORY 
```

### Serving

On application root, paste this on console
```bash
php -S 0.0.0.0:8888 &
# SERVING APPLICATION ON 0.0.0.0:8888
```

## Run

### Browser

- Access http://your-server/
- Replace your-server with your local host or PHP built in server ([Previous step](#serving))
- Choose your program to run