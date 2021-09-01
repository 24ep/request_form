
# import sys
# sku_list = sys.argv[1]
# sku_list = "'CDS23567382','CDS23567399','CDS23465312',CDS23466456','CDS23466630'"

# def product_connect():
from pyathena import connect
from pyathena.pandas.util import as_pandas
import pandas as pd
con = connect(aws_access_key_id= "AKIATS7CFP4VIFWP4BE4",
                    aws_secret_access_key= "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",
                    s3_staging_dir= "s3://aws-athena-query-results-246898065194-ap-southeast-1",
                    region_name= "ap-southeast-1")
     
sql_script_string = '''
select product.sku FROM cds_mdc.catalog_product_entity as product
where product.sku in ('''+str(sku_list)+'''); 
'''
query = pd.read_sql_query(sql_script_string, con)
return query
