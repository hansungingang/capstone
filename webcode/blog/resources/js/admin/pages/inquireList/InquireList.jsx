import React, { useEffect,useState } from 'react'
import { useParams } from 'react-router-dom';
import { useSelector,useDispatch } from 'react-redux';
import { fetchAllInquireAsync,fetchOneInquireAsync } from '../../reducers/reducer_inquiries';
import { DataGrid } from '@material-ui/data-grid';
import { Link } from 'react-router-dom';
export default function Inquire() {
    const allInquireData = useSelector(state => state.allInquiries)
    const dispatch = useDispatch();

    useEffect(() => {
        // Update the document title using the browser API
        (async () => {
            dispatch(fetchAllInquireAsync());
        })()
    },[]);
    
    const columns = [
        { field: 'id', headerName: 'ID', width: 100 },
        { field: 'email', headerName: 'Email', width: 200},
        { field: 'title', headerName: 'Title', width: 150 },
        {
          field: 'content',
          headerName: 'Content',
          width: 300,
        },
        {
            field: 'answer',
            headerName : 'Answer',
            width : 300
        },
        {
            field:"action",
            headerName:"Action",
            width:160,
            renderCell: (params) => {
                return(
                    <>
                    <Link to={"/admin/inquire/" +params.row.id}>
                        <button className="inquireListEdit">Edit</button>
                    </Link>
                    </>
                )
            }
        },
    ];
    
  return (
    <div className='userList'>
        <DataGrid
        disableSelectionOnClick
        rows={allInquireData}
        columns={columns}
        pageSize={10}
        checkboxSelection
        disableSelectionOnClick
      />
    </div>
  )
}
