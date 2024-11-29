<?php
/*
|--------------------------------------------------------------------------
| ABA PayWay API URL
|--------------------------------------------------------------------------
| API URL that is provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/eyJzdGF0dXMiOnsiY29kZSI6IjAwIiwibWVzc2FnZSI6IlN1Y2Nlc3MhIiwibGFuZyI6ImVuIn0sInN0ZXAiOiJhYmFwYXlfa2hxcl9yZXF1ZXN0X3FyIiwicXJfc3RyaW5nIjoiMDAwMjAxMDEwMjEyMzA1MTAwMTZhYmFha2hwcHh4eEBhYmFhMDExNTMyMzA2MTUxMDU5MTg5NTAyMDhBQkEgQmFuazUyMDQwMDAwNTMwMzExNjU0MDQxMDAwNTgwMktINTkxOFRSQyBFIFJlZ2lzdHJhdGlvbjYwMDNOXC9BNjIzNTA1MTBDQUZGMDEyMzg0MDcxNzUzNUExMjgyODI4MjgyODI4OTk1MjAwMTNGMUJGMDE2NDExRkRBNjgxNFBXT25saW5lUFctMi0wNjkwOHB1cmNoYXNlNzAwMTA2MzA0NDMxQyIsImFiYV9kYXRhIjoidTJqSXdXVGpKazhjRHFiTThzSzR2Y3JUNGhWNVF1dW5NSVFFMUFTdXcwOWFMN3BWK2JaSVRsV3VRUXRVWnJNbGdZRWFVYWd6TzE2WnpYamVYVTV6VFBNTkRYNFdzVjdKcGVibzVINTR5TlEyd2ZEVVwvMzJpb0tYdVZPZXBwSXVSanZNeHpHaVg2WTNmQmdZY2ZDZlFtUT09IiwidG9rZW5fdGltZSI6MTcyNTg4NzU1MCwidG9rZW4iOiIydWxrTEFkSGRoMktoK2hTOGN4TVF6XC9SN2JJTHhpbmU5dE5tYlNJS1F1SHdvek1YQW51Q1U2SWRmdHd4UEd3UUtUU0JPbExxa2dGV1VuOGd4ZlJLZmpcL2huY29salFpdmpxWnJlYW5SbHdZPSIsInRyYW5zYWN0aW9uX3N1bW1hcnkiOnsib3JkZXJfZGV0YWlscyI6eyJzdWJ0b3RhbCI6MTAwMCwidmF0X2VuYWJsZWQiOiIwIiwidmF0IjoiMCIsInNoaXBwaW5nIjowLCJ2YXRfYW1vdW50IjowLCJ0cmFuc2FjdGlvbl9mZWUiOjAsInRvdGFsIjoxMDAwLCJjdXJyZW5jeSI6IktIUiJ9LCJtZXJjaGFudCI6eyJuYW1lIjoiVFJDIEUgUmVnaXN0cmF0aW9uIiwibG9nbyI6Imh0dHBzOlwvXC9jaGVja291dC1zYW5kYm94LnBheXdheS5jb20ua2hcL21lcmNoYW50c1wvbWVyY2hhbnRfbG9nb1wvdHJjX2VfcmVnaXN0cmF0aW9uXzE2ODY4MDE1MTAucG5nIiwicHJpbWFyeV9jb2xvciI6IiMyNjM1NzkiLCJjYW5jZWxfdXJsIjoiIiwidGhlbWVzIjoiZGVmYXVsdCIsImZvbnRfZmFtaWx5IjoiU0ZfUHJvX0Rpc3BsYXkiLCJmb250X3NpemUiOjE0LCJiZ19jb2xvciI6IiNmZmZmZmYiLCJib3JkZXJfcmFkaXVzIjoiNiJ9fSwicGF5bWVudF9vcHRpb25zIjp7ImFiYXBheV9raHFyIjp7ImxhYmVsIjoiQUJBIEtIUVIifX0sImRvd25sb2FkX3FyIjoiaHR0cHM6XC9cL2NoZWNrb3V0LXNhbmRib3gucGF5d2F5LmNvbS5raFwvYXBpXC9wYXltZW50LWdhdGV3YXlcL3YxXC9wYXltZW50c1wvZG93bmxvYWQtY2hlY2tvdXQtcXI%2FYWJhX2RhdGE9ZWtFeU9WTlJUVUZ2WkhSSE5XVnFZbXRMYTB4YVJqbFJZMkp6ZDFOcVdscHpLeTl6Yldzd2RtbzFMemN3T0hOdFJVVlNSMncyTTB4TVdrcGFWMGRGVDBseGMza3ZlV2hyYkdkV2VsSkdZVk5XZDFKc0wwOXZWREk0THpobVUxaHhOVlY2WlhKeFJXOUpjMnM5IiwiZXhwaXJlX2luIjoxNzI1ODg3ODUwLCJleHBpcmVfaW5fc2VjIjoiMzAwIn0%3D');

/*
|--------------------------------------------------------------------------
| ABA PayWay API KEY
|--------------------------------------------------------------------------
| API KEY that is generated and provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_API_KEY', '308f1c5f450ff6d971bf8a805b4d18a6ef142464');

/*
|--------------------------------------------------------------------------
| ABA PayWay Merchant ID
|--------------------------------------------------------------------------
| Merchant ID that is generated and provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_MERCHANT_ID', 'ec000262');


class PayWayApiCheckout {

    /**
     * Returns the getHash
     * For PayWay security, you must follow the way of encryption for hash.
     *
     * @param string $transactionId
     * @param string $amount
     *
     * @return string getHash
     */
    public static function getHash($str) {

      //  echo 'before hash: '.$str.'<br><br>';

        $hash = base64_encode(hash_hmac('sha512', $str, ABA_PAYWAY_API_KEY, true));
        return $hash;
    }

    /**
     * Returns the getApiUrl
     *
     * @return string getApiUrl
     */
    public static function getApiUrl() {
        return ABA_PAYWAY_API_URL;
    }
}
