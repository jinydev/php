# array_merge without arguments upgrading
Since the addition of the spread operator, there might be cases where you'd want to use array_merge like so:

$merged = array_merge(...$arrayOfArrays);
To support the edge case where $arrayOfArrays would be empty, both array_merge and array_merge_recursive now allow an empty parameter list. An empty array will be returned if no input was passed.

