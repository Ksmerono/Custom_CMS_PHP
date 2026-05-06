-- Migration: Add is_home column to content_types
ALTER TABLE content_types ADD COLUMN is_home TINYINT(1) DEFAULT 0 AFTER description;

-- Migration: Add unique constraint to content_field_values
ALTER TABLE content_field_values ADD UNIQUE KEY unique_content_field (content_id, field_id);
