# Script to restore database from SQL backup
$backupFile = "backup_20251203_151453.sql"

Write-Host "Checking for backup file: $backupFile"
if (-not (Test-Path $backupFile)) {
    Write-Error "Backup file not found within the current directory!"
    exit 1
}

Write-Host "Checking Docker status..."
try {
    docker ps -q
} catch {
    Write-Error "Docker does not appear to be running. Please start Docker Desktop."
    exit 1
}

Write-Host "Restoring database from $backupFile..."
# Use docker compose to pipe the file into the mysql command inside the container
Get-Content $backupFile | docker compose exec -T mysql mysql -u root --password="" laravel

if ($LASTEXITCODE -eq 0) {
    Write-Host "Restoration completed successfully!" -ForegroundColor Green
} else {
    Write-Error "Restoration failed with exit code $LASTEXITCODE"
}