<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

trait ActivityLogTrait
{
    /**
     * Log aktivitas ke database
     * 
     * @param string $action - CREATE, READ, UPDATE, DELETE, PROCESS
     * @param string $tableName - Nama tabel
     * @param mixed $recordId - ID record yang diubah
     * @param array $changes - Array berisi changes: ['old' => [...], 'new' => [...]]
     * @return void
     */
    public function logActivity(string $action, string $tableName, $recordId = null, array $changes = [])
    {
        try {
            ActivityLog::create([
                'user_id' => Session::get('user_id'), // Asumsi session punya user_id
                'role' => Session::get('role'),
                'action' => $action,
                'table_name' => $tableName,
                'record_id' => $recordId,
                'changes' => $changes ?? null,
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        } catch (\Exception $e) {
            // Log error tapi jangan hentikan eksekusi
            \Log::error('Failed to log activity: ' . $e->getMessage());
        }
    }

    /**
     * Log CREATE action
     */
    public function logCreate(string $tableName, $recordId, array $newData)
    {
        $this->logActivity('CREATE', $tableName, $recordId, [
            'old' => [],
            'new' => $newData
        ]);
    }

    /**
     * Log UPDATE action
     */
    public function logUpdate(string $tableName, $recordId, array $oldData, array $newData)
    {
        // Hanya catat field yang berubah
        $changes = [];
        foreach ($newData as $key => $value) {
            if (($oldData[$key] ?? null) !== $value) {
                $changes[$key] = [
                    'old' => $oldData[$key] ?? null,
                    'new' => $value
                ];
            }
        }

        if (!empty($changes)) {
            $this->logActivity('UPDATE', $tableName, $recordId, $changes);
        }
    }

    /**
     * Log DELETE action
     */
    public function logDelete(string $tableName, $recordId, array $deletedData)
    {
        $this->logActivity('DELETE', $tableName, $recordId, [
            'old' => $deletedData,
            'new' => []
        ]);
    }

    /**
     * Log PROCESS action (untuk transaksi kompleks seperti order processing)
     */
    public function logProcess(string $tableName, $recordId, string $processName, array $details = [])
    {
        $this->logActivity('PROCESS', $tableName, $recordId, [
            'process' => $processName,
            'details' => $details
        ]);
    }
}
