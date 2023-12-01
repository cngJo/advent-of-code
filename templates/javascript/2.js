import path from 'path';
import fs from 'fs/promises'

/**
 * @param {string} filename 
 */
async function main(filename) {
    const content = (await fs.readFile(path.resolve(filename))).toString()

}

await main(process.argv[2] ?? "input.txt");