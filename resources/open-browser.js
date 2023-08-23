import open from 'open';

const url = process.argv[2];

(async () => {
    await open(url);
})();
