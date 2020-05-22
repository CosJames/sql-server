<?php
    /**
     * This file is used to access Creaton functions which can be used in querying
     *
     * PHP version LATEST
     * Code version 0.1
     *
     * LICENSE: This source file is subject to version 3.01 of the PHP license
     * that is available through the world-wide-web at the following URI:
     * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
     * the PHP License and are unable to obtain it through the web, please
     * send a note to license@php.net so we can mail you a copy immediately.
     *
     * @author Creaton <codanielyt@gmail.com>
     */
    class CreatonFunctions {
        #region generateId()
        /**
         * Summary
         * @param String $prefix - Optional. Specifies a prefix to the unique ID (useful if two scripts generate ids at exactly the same microsecond).
         * Leave as Empty string if not needed
         * @param Boolean $entropy - Optional. Specifies more entropy at the end of the return value. This will make the result more unique. When set to TRUE, the return string will be 23 characters. Default is FALSE, and the return string will be 13 characters long
         * @return uniqid() - Return a generated uid
         */
        public function generateId($prefix = '', $entropy = false)
        {
            return uniqid($prefix, $entropy);
        }
        #endregion

        #region hashPassword()
        /**
         * Summary
         * @param String $password - The string that will be converted to hash
         * @param Int $algo - These are algorithms that will be applied when creating a hash.
         * Leave as Empty string if not needed.
         * PASSWORD_DEFAULT - Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP. For that reason, the length of the result from using this identifier can change over time. Therefore, it is recommended to store the result in a database column that can expand beyond 60 characters (255 characters would be a good choice).
         * PASSWORD_BCRYPT - Use the CRYPT_BLOWFISH algorithm to create the hash. This will produce a standard crypt() compatible hash using the "$2y$" identifier. The result will always be a 60 character string, or FALSE on failure.
         * PASSWORD_ARGON2I - Use the Argon2i hashing algorithm to create the hash. This algorithm is only available if PHP has been compiled with Argon2 support.
         * PASSWORD_ARGON2ID - Use the Argon2id hashing algorithm to create the hash. This algorithm is only available if PHP has been compiled with Argon2 support.
         * @param Array option - An associative array containing options. If omitted, a random salt will be created and the default cost will be used.
         * @return uniqid() - Return a generated uid
         */
        public function hashPassword($password, $algo, $options)
        {
            return password_hash($password, $algo, $options);
        }
        #endregion

        #region verifyHashPassword()
        /**
         * Summary
         * @param String $password - The string that will be verify if it match to the hash.
         * @param String $hash - The hash that will be compared to the password variable.
         */
        public function verifyHashPassword($password, $hash)
        {

            return password_verify($password, $hash);
        }
        #endregion
    }