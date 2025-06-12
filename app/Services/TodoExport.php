<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TodoExport implements TodoExportInterface {
    public function export(array $data): string {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = ['ID', 'Title', 'Assignee', 'Due Date', 'Time Tracked', 'Status', 'Priority'];
        $sheet->fromArray($headers, null, 'A1');
        $totalTimeTracked = 0;
        foreach ($data as $key => $todo) {
            $row = $index + 2;
            $timeTracked = $todo['time_tracked'] ?? 0;
            $totalTimeTracked += $timeTracked;
            $sheet->fromArray([
                $todo['id'],
                $todo['title'],
                $todo['assignee'],
                $todo['due_date'],
                $todo['time_tracked'],
                $todo['status'],
                $todo['priority'],
            ], null, 'A' . $row);
        }

        $summaryRow = count($todos) + 3; // Leave one empty row
        $sheet->setCellValue("A$summaryRow", 'Summary');
        $sheet->setCellValue("B$summaryRow", 'Total Todos:');
        $sheet->setCellValue("C$summaryRow", count($todos));
        $sheet->setCellValue("F$summaryRow", 'Total Time Tracked:');
        $sheet->setCellValue("G$summaryRow", $totalTimeTracked);


        $sheet->getStyle("A$summaryRow:G$summaryRow")->getFont()->setBold(true);

        $filePath = storage_path('app/exports/todos_array.xlsx');
        (new Xlsx($spreadsheet))->save($filePath);

        return $filePath;

    }
}