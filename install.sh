echo "-> CLONING REPOSITORY...\n" &&
git clone https://github.com/jorgejr568/cep-binarysearch.git &&
echo "-> ENTERING ON PROJECT DIRECTORY\n" &&
cd cep-binarysearch/ &&
echo "-> UNZIPING CEP DAT FILE\n" &&
unzip -d ./app/data ./app/data/cep.zip &&
echo "\n-> YOU'RE ALL SET UP!"