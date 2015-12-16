<?php
/**
 * Cakephp3Base64Email
 * CakePHP3 extension to encode the message body with Base64.
 *
 * @copyright    Copyright © 2015 oh-sky
 * @link         https://github.com/oh-sky/cakephp3-base64-email
 * @package      Cakephp3Base64Email
 * @license      MIT License
 * @author oh-sky <yoshihiro.ohsuka@gmail.com>
 */

namespace OhSky;

use Cake\Mailer\Email;

/**
 * Cakephp3Base64Email
 * CakePHP3 extension to encode the message body with Base64.
 *
 * @package      Cakephp3Base64Email
 */
class Cakephp3Base64Email extends Email
{

    protected static $_maxLength = 76;

    /**
     * Build and set all the view properties needed to render the templated emails.
     * If there is no template set, the $content will be returned in a hash
     * of the text content types for the email.
     *
     * @param string $content The content passed in from send() in most cases.
     * @return array The rendered content with html and text keys.
     */
    protected function _renderTemplates($content) {
        $rendered = parent::_renderTemplates($content);
        array_walk($rendered, function(&$val, $key) {
                $tmpRow = '';
                $val = base64_encode($val);
                $length = strlen($val);
                for ($offset = 0; $offset < $length; $offset += self::$_maxLength) {
                    $tmpRow .= substr($val, $offset, self::$_maxLength);
                    $tmpRow .= "\n";
                }
                $val = $tmpRow;
            });
        return $rendered;
    }


    /**
     * Return string 'base64' for Content-Transfer Encoding
     *
     * @return string 'base64'
     */
    protected function _getContentTransferEncoding() {
        return 'base64';
    }
}
