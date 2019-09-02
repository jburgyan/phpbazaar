ALTER TABLE vendors ADD COLUMN _search TSVECTOR;

UPDATE vendors SET _search =
                       to_tsvector('english', ARRAY_TO_STRING(ARRAY[vendors.name, vendors.about, "vendors"."shortDescription"], ' || '' '' || '));

CREATE INDEX vendors_search ON vendors USING gin(_search);

CREATE TRIGGER vendors_vector_update
    BEFORE INSERT OR UPDATE ON vendors
    FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger(_search, 'pg_catalog.english', name, about, "shortDescription");

