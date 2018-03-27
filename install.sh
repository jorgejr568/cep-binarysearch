echo "-> CLONING REPOSITORY..." &&
git clone https://github.com/jorgejr568/cep-binarysearch.git &&
echo "-> ENTERING ON PROJECT DIRECTORY" &&
cd cep-binarysearch/ &&
echo "-> UNZIPING CEP DAT FILE" &&
unzip -d ./app/data ./app/data/cep.zip &&
echo "-> YOU'RE ALL SET UP!"
