<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EmailStatus;
use Symfony\Component\Mime\Address;

class Email extends Model
{
    public function queue(
        Address $to,
        Address $from,
        string $subject,
        string $html,
        ?string $text = null
    ) {
        $query = <<<SQL
        INSERT INTO `emails` (`subject`, `status`, `text_body`, `html_body`, `meta`, `created_at`)
        VALUES (:subject, :status, :text_body, :html_body, :meta, NOW())
        SQL;

        $this->db->prepare($query)->execute([
            'subject' => $subject,
            'html_body' => $html,
            'text_body' => $text,
            'status' => EmailStatus::Queue->value,
            'meta' => json_encode([
                'to' => $to->toString(),
                'from' => $from->toString()
            ])
        ]);
    }

    public function getEmailsByStatus(EmailStatus $status): array
    {
        $stmp = $this->db->prepare('SELECT * FROM `emails` WHERE `status` = ?');

        $stmp->execute([$status->value]);

        return $stmp->fetchAll(\PDO::FETCH_OBJ);
    }

    public function markEmailSent(int $id): void
    {
        $query = <<<SQL
        UPDATE `emails` SET `status` = :status, `sent_at`= NOW() WHERE `id` = :id
        SQL;

        $stmp = $this->db->prepare($query);

        $stmp->execute([
            'id' => $id,
            'status' => EmailStatus::Sent->value,
        ]);
    }
}
