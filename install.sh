echo "-> CLONING REPOSITORY..." &&
git clone https://github.com/jorgejr568/file-structure-organization-algorithms.git &&
echo "-> ENTERING ON PROJECT DIRECTORY" &&
cd file-structure-organization-algorithms/ &&
echo "-> UNZIPING CEP DAT FILE" &&
unzip -d ./app/data ./app/data/cep.zip &&
echo "-> REMOVING INSTALL SCRIPT" &&
rm ../install.sh &&
echo "-> YOU'RE ALL SET UP!"
