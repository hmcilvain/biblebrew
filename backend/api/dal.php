<?php
require_once 'config.php';
require_once 'db.php';

class DAL
{

    // ---------- EVENTS ----------
    public static function logEvent($data)
    {
        $stmt = db()->prepare("
            INSERT INTO events (uid, type, path, referrer, ip, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");

        $stmt->execute([
            $data['uid'],
            $data['type'],
            $data['path'],
            $data['ref'],
            $data['ip']
        ]);
    }

    // ---------- DOWNLOADS ----------
    public static function logDownload($data)
    {
        $stmt = db()->prepare("
            INSERT INTO downloads (uid, file_key, ip, created_at)
            VALUES (?, ?, ?, NOW())
        ");

        $stmt->execute([
            $data['uid'],
            $data['file'],
            $data['ip']
        ]);
    }

    // ---------- SUBSCRIBERS ----------
    public static function addSubscriber($data)
    {
        try {
            $stmt = db()->prepare("
                INSERT INTO subscribers (email, uid, ip, created_at)
                VALUES (?, ?, ?, NOW())
            ");

            $stmt->execute([
                $data['email'],
                $data['uid'],
                $data['ip']
            ]);

            return true;
        } catch (PDOException $e) {
            // Duplicate email = ignore
            return false;
        }
    }

    // ---------- ANALYTICS ----------
    public static function getDownloadCounts()
    {
        $stmt = db()->query("
            SELECT file_key, COUNT(*) as total
            FROM downloads
            GROUP BY file_key
        ");

        return $stmt->fetchAll();
    }

    public static function getSubscriberCount()
    {
        return db()->query("SELECT COUNT(*) FROM subscribers")->fetchColumn();
    }

    public static function getRecentEvents($limit = 50)
    {
        $stmt = db()->prepare("
            SELECT * FROM events
            ORDER BY created_at DESC
            LIMIT ?
        ");

        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}
