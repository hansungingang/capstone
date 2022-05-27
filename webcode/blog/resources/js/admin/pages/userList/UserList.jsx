import {React,useState, useEffect} from 'react'
import { DataGrid } from '@material-ui/data-grid';
import DeleteOutlineIcon from '@material-ui/icons/DeleteOutline';
import { Link } from 'react-router-dom';
import { useSelector,useDispatch, connect } from 'react-redux';
import { fetchUserAsync,searchEmailUserAsync } from '../../reducers/reducer_users';
import TextField from '@material-ui/core/TextField';


function UserList() {
    const userData = useSelector(state => state.allUsers)
    const dispatch = useDispatch();

    useEffect(() => {
        // Update the document title using the browser API
        (async () => {
            dispatch(fetchUserAsync());
        })()
    },[]);
    
    const handleSearch = (event)=>{
        if(event.target.value !== ''){
            (async () => {
                dispatch(searchEmailUserAsync(event.target.value));
            })()
        }
    }
    
    const columns = [
        { field: 'id', headerName: 'ID', width: 100 },
        { field: 'name', headerName: 'Username', width: 130},
        { field: 'email', headerName: 'Email', width: 200 },
        {
          field: 'type',
          headerName: 'Type',
          width: 120,
        },
        {
            field:"action",
            headerName:"Action",
            width:160,
            renderCell: (params) => {
                return(
                    <>
                    <Link to={"/admin/user/" +params.row.id}>
                        <button className="userListEdit">Edit</button>
                    </Link>
                    </>
                )
            }
        },
    ];
    
  return (
    <div className='userList'>
        <TextField
          id="outlined-basic"
          variant="outlined"
          label="Search with Email"
          onChange={(event) => {handleSearch(event)}}
        />

        <DataGrid
        disableSelectionOnClick
        rows={userData}
        columns={columns}
        pageSize={8}
        checkboxSelection
        disableSelectionOnClick
      />
    </div>
  )
}

export default UserList;