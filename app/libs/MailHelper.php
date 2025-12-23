<?php

class MailHelper {
    public static function sendWithAttachment($to, $subject, $message, $attachmentContent, $attachmentName) {
        $from = "EventHorizons <noreply@eventhorizons.com>";
        $boundary = md5(time());

        $headers = "From: $from\r\n";
        $headers .= "Reply-To: $from\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

        // Message body
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $body .= $message . "\r\n\r\n";

        // Attachment
        $body .= "--$boundary\r\n";
        $body .= "Content-Type: application/pdf; name=\"$attachmentName\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$attachmentName\"\r\n\r\n";
        $body .= chunk_split(base64_encode($attachmentContent)) . "\r\n\r\n";
        $body .= "--$boundary--";

        $result = mail($to, $subject, $body, $headers);
        
        $logFile = __DIR__ . '/../../logs/email_debug.log';
        $error = error_get_last();
        $logMsg = date('[Y-m-d H:i:s] ') . "mail() call to $to - Result: " . ($result ? "TRUE" : "FALSE");
        if (!$result && $error) {
            $logMsg .= " - Error: " . $error['message'];
        }
        $logMsg .= PHP_EOL;
        file_put_contents($logFile, $logMsg, FILE_APPEND);
        
        return $result;
    }

    public static function send($to, $subject, $message) {
        $from = "EventHorizons <noreply@eventhorizons.com>";
        $headers = "From: $from\r\n";
        $headers .= "Reply-To: $from\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        $result = mail($to, $subject, $message, $headers);
        
        $logFile = __DIR__ . '/../../logs/email_debug.log';
        $error = error_get_last();
        $logMsg = date('[Y-m-d H:i:s] ') . "mail() simple call to $to - Result: " . ($result ? "TRUE" : "FALSE");
        if (!$result && $error) {
            $logMsg .= " - Error: " . $error['message'];
        }
        $logMsg .= PHP_EOL;
        file_put_contents($logFile, $logMsg, FILE_APPEND);
        
        return $result;
    }
}
