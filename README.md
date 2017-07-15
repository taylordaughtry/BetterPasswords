# BetterPasswords
<a href="https://nakedsecurity.sophos.com/2016/08/18/nists-new-password-rules-what-you-need-to-know/' target="_blank">NIST-certified</a> password support for Craft CMS. Minimum entropy, length, and rejection of the top 10,000 most common passwords.

## Entropy
Enforce a minimum required 'uniqueness' for passwords. Passwords with lower entropy are much more likely to be cracked.

## Minimum Length
The NIST reccommends in their newest release to enforce a minimum length of 10 characters.

## Reject Common Passwords
Many vectors happen from commonly-used passwords. BetterPasswords rejects at any attempts to use one of the top 10,000 most common passwords from the last year.
