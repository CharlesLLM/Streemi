<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241218185152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add score column to media table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media ADD score DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media DROP score');
    }
}
