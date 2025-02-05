export function toCamelCase(snakeCase) {
    return snakeCase.replace(/_([a-z])/g, (match, letter) => letter.toUpperCase());
}