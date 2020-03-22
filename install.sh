echo "-> CLONING REPOSITORY..." &&
git clone https://github.com/jorgejr568/file-structure-organization-algorithms.git &&
echo "-> ENTERING ON PROJECT DIRECTORY" &&
cd file-structure-organization-algorithms/ &&
echo "-> DOWNLOADING BOLSA ZIP FILE" &&
wget https://jorgejuniorx.com.br/projects/cefet-rj/file-structure-organization-algorithms/app/data/bolsa.zip -O ./app/data/bolsa.zip
echo "-> UNZIPING BOLSA DAT FILE" &&
unzip -d ./app/data ./app/data/bolsa.zip &&
echo "-> UNZIPING CEP DAT FILE" &&
unzip -d ./app/data ./app/data/cep.zip &&
echo "-> MAPPING BOLSA PAK FILES" &&
php ./bolsa-hash-generator.php &&
echo "-> REMOVING INSTALL SCRIPT" &&
rm ../install.sh &&
echo "-> YOU'RE ALL SET UP!"
