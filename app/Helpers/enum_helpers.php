<?php

function getApprovalStatus(string $status): string{
    return \App\Enums\ApprovalStatus::tryFrom($status)->toString();
}

function isApprovalRejected(string $status): bool {
    return \App\Enums\ApprovalStatus::tryFrom($status)->rejected();
}

function getApprovalStatusColor(string $status): string {
    return \App\Enums\ApprovalStatus::tryFrom($status)->color();
}
