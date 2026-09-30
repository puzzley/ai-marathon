# #backend channel – 2026-09-18 to 2026-09-20

**Sara (tech lead), 2026-09-18 10:02:** Since we added the second app server behind the load balancer last month, some customers can't open their attachments. If a file was uploaded to server A, server B doesn't have it.

**Omid, 10:05:** Also, the uploads disk on server A is at 85%. We have about 120 GB of files now.

**Lena, 10:09:** And the nightly backup of the uploads folder now takes almost 3 hours.

**Sara, 10:15:** Options I see: 1) a shared network disk (NFS) mounted on both servers, 2) store the files in PostgreSQL, 3) S3-compatible object storage. We could self-host MinIO.

**Omid, 10:21:** NFS makes the file server a single point of failure, and nobody in ops has run NFS before.

**Lena, 10:24:** Files in PostgreSQL would make the database huge. Database backups and restores would get much slower.

**Sara, 10:30:** Object storage works from any number of servers, and MinIO runs in Docker, so we can use the same setup locally.

**Omid, 10:34:** We'd need to move the existing 120 GB. I can write a migration script.

**Lena, 10:40:** Downloads should use signed URLs that expire, so files are never public.

**Sara, 2026-09-20 09:10:** Decision: we use S3-compatible object storage with self-hosted MinIO. Omid owns the migration script, Lena the signed URLs. This replaces ADR-0003. We also need to add MinIO to our monitoring.
