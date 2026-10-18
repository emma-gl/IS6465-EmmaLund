<?php

// Lab 2C: Constructors, Constants, and Inheritance

echo '<h1>Lab 2C: User and Tutor Classes</h1>';

function cleanText($value)
{
    // TODO: Return the value with extra spaces removed.
    return trim($value);
}

class User
{
    public const STATUS_ACTIVE = 'active';
    public $name;
    public $email;
    public $status;

    public function __construct($name, $email)
    {
        // TODO: Clean and store the name.
        $this->name = cleanText($name);
        // TODO: Clean, lowercase, and store the email.
        $this->email = strtolower(cleanText($email));
        // TODO: Assign STATUS_ACTIVE to status.
        $this->status = self::STATUS_ACTIVE;
    }
}

class Tutor extends User
{
    public $subject;

    public function __construct($name, $email, $subject)
    {
        // TODO: Call the parent constructor.
        parent::__construct($name, $email);
        // TODO: Clean and store the subject.
        $this->subject = cleanText($subject);
    }

    public function profileSummary()
    {
        // TODO: Return the tutor's name, email, and subject.
        return "$this->name ($this->email) - Tutor for $this->subject";
    }
}

// TODO: Create a Tutor object using sample data.
$tutor = new Tutor("Jordan Lee", "jlee@example.com", "PHP");
// TODO: Display profileSummary().
echo $tutor->profileSummary();