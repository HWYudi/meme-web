import { Inertia } from "@inertiajs/inertia";
import React from "react";
import { useState } from "react";
import { usePage } from "@inertiajs/inertia-react";
import { Link } from "@inertiajs/inertia-react";
import moment from "moment";
import { Head } from "@inertiajs/inertia-react";

export default function detailPost({ post, user }) {
    const { flash } = usePage().props;
    console.log(flash.message);
    const [disabled, setdisabled] = useState(false);
    const [id, setid] = useState(post.id);
    const [commentId, setcommentId] = useState();
    const [Body, setBody] = useState("");
    const [reply, setreply] = useState("");
    const [loading, setloading] = useState(false);
    const [editTitle, seteditTitle] = useState();
    console.log(post);
    const handlelike = (id) => {
        Inertia.post(
            "/posts/" + id + "/like",
            {},
            {
                onProgress: () => setdisabled(true),
                onStart: () => setdisabled(true),
                onFinish: () => setdisabled(false),
                preserveScroll: true,
            }
        );
    };

    const handleunlike = (id) => {
        Inertia.delete("/posts/" + id + "/unlike", {
            onProgress: () => setdisabled(true),
            onStart: () => setdisabled(true),
            onFinish: () => setdisabled(false),
            preserveScroll: true,
        });
    };

    const handlecomment = (e) => {
        e.preventDefault();
        const formData = {
            body: Body,
            post_id: id,
        };
        Inertia.post(`/comment`, formData, {
            preserveScroll: true,
            onProgress: () => setloading(true),
            onStart: () => setloading(true),
            onFinish: () => {
                setloading(false), setBody("");
            },
        });
    };

    const handlereply = (e, commentId) => {
        e.preventDefault();
        const formData = {
            body: reply,
            comment_id: commentId,
        };
        Inertia.post(`/reply`, formData, {
            preserveScroll: true,
            onFinish: () => setreply(""),
        });
        console.log(commentId);
    };

    const handleUpdate = (e) => {
        e.preventDefault();
        const formData = {
            title: editTitle,
        };
        Inertia.patch(`/${post.user.name}/post/${post.id}`, formData, {
            preserveScroll: true,
            onFinish: () => {
                seteditTitle(null);
            },
            onSuccess: () => {
                togglePopupEdit();
            },
        });
    };
    return (
        <div className="px-4 lg:px-10 py-4">
            <Head>
                <title>{`MIMERS - ${post.title}`}</title>
            </Head>

            <div className="popupDelete hidden fixed z-40 inset-0 flex items-center justify-center bg-black bg-opacity-80">
                <div className="max-w-md bg-black rounded-lg p-2 px-5 w-full">
                    <div className="flex gap-2 py-4 items-start">
                        <img
                            src={`/storage/${post.user.image}`}
                            alt=""
                            className="w-12 h-12 object-cover rounded-full"
                        />
                        <div>
                            <h1 className="font-semibold">
                                {post.user.username}
                            </h1>
                            <p className="text-sm text-white text-opacity-50">
                                @{post.user.name}
                            </p>
                        </div>
                    </div>
                    <p className="text-white font-medium text-sm">{post.title}</p>
                    <img
                        src={`/storage/${post.body}`}
                        alt=""
                        className="w-full h-fit object-cover rounded-lg"
                    />
                    <h2 class="text-lg font-semibold text-white mb-4">
                        Confirmation
                    </h2>
                    <p class="mb-4">
                        Are you sure you want to delete this post?
                    </p>
                    <form method="POST" id="routeDelete" action="">
                        <div class="flex justify-end">
                            <button
                            onClick={togglePopupDelete}
                                type="button"
                                class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg mr-2 hover:bg-gray-700"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                            >
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div className="popupEdit hidden fixed z-40 inset-0 flex items-center justify-center bg-black bg-opacity-80">
                <div className="bg-black rounded-lg p-2 px-5 w-full max-w-md ">
                    <div
                        className="p-4 absolute top-0 right-0 cursor-pointer"
                        onClick={togglePopupEdit}
                    >
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M13.41 12L19.71 5.71C19.8983 5.5217 20.0041 5.2663 20.0041 5C20.0041 4.7337 19.8983 4.4783 19.71 4.29C19.5217 4.1017 19.2663 3.99591 19 3.99591C18.7337 3.99591 18.4783 4.1017 18.29 4.29L12 10.59L5.71 4.29C5.5217 4.1017 5.2663 3.99591 5 3.99591C4.7337 3.99591 4.4783 4.1017 4.29 4.29C4.1017 4.4783 3.99591 4.7337 3.99591 5C3.99591 5.2663 4.1017 5.5217 4.29 5.71L10.59 12L4.29 18.29C4.19627 18.383 4.12188 18.4936 4.07111 18.6154C4.02034 18.7373 3.9942 18.868 3.9942 19C3.9942 19.132 4.02034 19.2627 4.07111 19.3846C4.12188 19.5064 4.19627 19.617 4.29 19.71C4.38296 19.8037 4.49356 19.8781 4.61542 19.9289C4.73728 19.9797 4.86799 20.0058 5 20.0058C5.13201 20.0058 5.26272 19.9797 5.38458 19.9289C5.50644 19.8781 5.61704 19.8037 5.71 19.71L12 13.41L18.29 19.71C18.383 19.8037 18.4936 19.8781 18.6154 19.9289C18.7373 19.9797 18.868 20.0058 19 20.0058C19.132 20.0058 19.2627 19.9797 19.3846 19.9289C19.5064 19.8781 19.617 19.8037 19.71 19.71C19.8037 19.617 19.8781 19.5064 19.9289 19.3846C19.9797 19.2627 20.0058 19.132 20.0058 19C20.0058 18.868 19.9797 18.7373 19.9289 18.6154C19.8781 18.4936 19.8037 18.383 19.71 18.29L13.41 12Z"
                                fill="white"
                            />
                        </svg>
                    </div>
                    {loading ? (
                        <div className="flex items-center justify-center">
                            <span class="loader"></span>
                        </div>
                    ) : (
                        <form className="space-y-4" onSubmit={handleUpdate}>
                            <div>
                                <div className="flex gap-2 py-4 items-start">
                                    <img
                                        src={`/storage/${post.user.image}`}
                                        alt=""
                                        className="w-12 h-12 object-cover rounded-full"
                                    />
                                    <div>
                                        <h1 className="font-semibold">
                                            {post.user.username}
                                        </h1>
                                        <p className="text-sm text-white text-opacity-50">
                                            @{post.user.name}
                                        </p>
                                    </div>
                                </div>
                                <div className="flex w-full">
                                    {user && (
                                        <img
                                            src={"/storage/" + post.body}
                                            alt=""
                                            className="w-full h-full object-cover rounded-lg"
                                        />
                                    )}
                                </div>
                            </div>
                            <div>
                                <input
                                    type="text"
                                    name="title"
                                    value={editTitle}
                                    placeholder={post.title}
                                    onChange={(e) =>
                                        seteditTitle(e.target.value)
                                    }
                                    className="text-white w-full border-t border-white border-opacity-45 py-2 focus:outline-none bg-transparent"
                                />
                                <p className="text-white text-opacity-40 text-sm">
                                    {editTitle
                                        ? editTitle.length
                                        : post.title.length}
                                    /255
                                </p>
                            </div>
                            <div>
                                <button
                                    type="submit"
                                    className="w-full px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition-colors duration-300 ease-in-out"
                                >
                                    Update
                                </button>
                            </div>
                        </form>
                    )}
                </div>
            </div>

            <div className="w-full lg:w-2/3 flex gap-2 relative">
                <img
                    src={"/storage/" + post.user.image}
                    alt=""
                    className="w-12 h-12 object-cover rounded-full"
                />
                <div className="w-full">
                    <div className="flex justify-between">
                        <div className="mb-2">
                            <h1 className="font-semibold text-base text-[#DCDEE0]">
                                {post.user.name}
                            </h1>
                            <p className="text-[#E1E3E4] break-all text-sm">
                                {post.title}
                            </p>
                        </div>
                        <div>
                            <button
                                className="flex items-center justify-center w-10 h-10 rounded-full hover:bg-white hover:bg-opacity-10 cursor-pointer"
                                onClick={() => dropdown(post.id)}
                            >
                                <svg
                                    width="18"
                                    height="18"
                                    viewBox="0 0 68 17"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fillRule="evenodd"
                                        clipRule="evenodd"
                                        d="M8.94595 16.9279C13.5384 16.9279 17.2613 13.205 17.2613 8.61263C17.2613 4.0202 13.5384 0.29731 8.94595 0.29731C4.35352 0.29731 0.63063 4.0202 0.63063 8.61263C0.63063 13.205 4.35352 16.9279 8.94595 16.9279ZM42.2072 8.61263C42.2072 13.205 38.4843 16.9279 33.8919 16.9279C29.2995 16.9279 25.5766 13.205 25.5766 8.61263C25.5766 4.0202 29.2995 0.29731 33.8919 0.29731C38.4843 0.29731 42.2072 4.0202 42.2072 8.61263ZM67.1532 8.61263C67.1532 13.205 63.4303 16.9279 58.8378 16.9279C54.2454 16.9279 50.5225 13.205 50.5225 8.61263C50.5225 4.0202 54.2454 0.29731 58.8378 0.29731C63.4303 0.29731 67.1532 4.0202 67.1532 8.61263Z"
                                        fill="white"
                                    />
                                </svg>
                            </button>
                            <div
                                className="absolute right-0 mt-2 w-48 bg-[#262626] shadow-lg rounded-md overflow-hidden text-white hidden"
                                id={`dropdown-${post.id}`}
                            >
                                {post.user.id === user.id ? (
                                    <div>
                                        <button
                                            href="#"
                                            onClick={() => togglePopupEdit()}
                                            className="flex w-full items-center gap-2 px-4 py-2 text-sm hover:bg-[#222222]"
                                        >
                                            <svg
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <mask
                                                    id="path-1-outside-1_2165_508"
                                                    maskUnits="userSpaceOnUse"
                                                    x="3"
                                                    y="4"
                                                    width="17"
                                                    height="17"
                                                    fill="black"
                                                >
                                                    <rect
                                                        fill="white"
                                                        x="3"
                                                        y="4"
                                                        width="17"
                                                        height="17"
                                                    />
                                                    <path d="M13.5858 7.41421L6.39171 14.6083C6.19706 14.8029 6.09974 14.9003 6.03276 15.0186C5.96579 15.1368 5.93241 15.2704 5.86564 15.5374L5.20211 18.1915C5.11186 18.5526 5.06673 18.7331 5.16682 18.8332C5.2669 18.9333 5.44742 18.8881 5.80844 18.7979L5.80845 18.7979L8.46257 18.1344C8.72963 18.0676 8.86316 18.0342 8.98145 17.9672C9.09974 17.9003 9.19706 17.8029 9.39171 17.6083L16.5858 10.4142L16.5858 10.4142C17.2525 9.74755 17.5858 9.41421 17.5858 9C17.5858 8.58579 17.2525 8.25245 16.5858 7.58579L16.4142 7.41421C15.7475 6.74755 15.4142 6.41421 15 6.41421C14.5858 6.41421 14.2525 6.74755 13.5858 7.41421Z" />
                                                </mask>
                                                <path
                                                    d="M6.39171 14.6083L7.80593 16.0225L7.80593 16.0225L6.39171 14.6083ZM13.5858 7.41421L12.1716 6L12.1716 6L13.5858 7.41421ZM16.4142 7.41421L15 8.82843L15 8.82843L16.4142 7.41421ZM16.5858 7.58579L18 6.17157L18 6.17157L16.5858 7.58579ZM16.5858 10.4142L18 11.8284L18 11.8284L16.5858 10.4142ZM9.39171 17.6083L7.9775 16.1941L7.9775 16.1941L9.39171 17.6083ZM5.86564 15.5374L7.80593 16.0225L7.80593 16.0225L5.86564 15.5374ZM5.20211 18.1915L3.26183 17.7065L3.26183 17.7065L5.20211 18.1915ZM5.80845 18.7979L5.32338 16.8576L5.23624 16.8794L5.15141 16.9089L5.80845 18.7979ZM8.46257 18.1344L7.97751 16.1941L7.9775 16.1941L8.46257 18.1344ZM5.16682 18.8332L6.58103 17.419L6.58103 17.419L5.16682 18.8332ZM5.80844 18.7979L6.29351 20.7382L6.38065 20.7164L6.46549 20.6869L5.80844 18.7979ZM8.98145 17.9672L7.99605 16.2268L7.99605 16.2268L8.98145 17.9672ZM16.5858 10.4142L18 11.8284L18 11.8284L16.5858 10.4142ZM6.03276 15.0186L4.29236 14.0332L4.29236 14.0332L6.03276 15.0186ZM7.80593 16.0225L15 8.82843L12.1716 6L4.9775 13.1941L7.80593 16.0225ZM15 8.82843L15.1716 9L18 6.17157L17.8284 6L15 8.82843ZM15.1716 9L7.9775 16.1941L10.8059 19.0225L18 11.8284L15.1716 9ZM3.92536 15.0524L3.26183 17.7065L7.1424 18.6766L7.80593 16.0225L3.92536 15.0524ZM6.29352 20.7382L8.94764 20.0746L7.9775 16.1941L5.32338 16.8576L6.29352 20.7382ZM3.26183 17.7065C3.233 17.8218 3.15055 18.1296 3.12259 18.4155C3.0922 18.7261 3.06509 19.5599 3.7526 20.2474L6.58103 17.419C6.84671 17.6847 6.99914 18.0005 7.06644 18.2928C7.12513 18.5478 7.10965 18.7429 7.10358 18.8049C7.09698 18.8724 7.08792 18.904 7.097 18.8631C7.10537 18.8253 7.11788 18.7747 7.1424 18.6766L3.26183 17.7065ZM5.15141 16.9089L5.1514 16.9089L6.46549 20.6869L6.46549 20.6869L5.15141 16.9089ZM5.32338 16.8576C5.22531 16.8821 5.17467 16.8946 5.13694 16.903C5.09595 16.9121 5.12762 16.903 5.19506 16.8964C5.25712 16.8903 5.45223 16.8749 5.70717 16.9336C5.99955 17.0009 6.31535 17.1533 6.58103 17.419L3.7526 20.2474C4.44011 20.9349 5.27387 20.9078 5.58449 20.8774C5.87039 20.8494 6.17822 20.767 6.29351 20.7382L5.32338 16.8576ZM7.9775 16.1941C7.95279 16.2188 7.9317 16.2399 7.91214 16.2593C7.89271 16.2787 7.87671 16.2945 7.86293 16.308C7.84916 16.3215 7.83911 16.3312 7.83172 16.3382C7.82812 16.3416 7.82545 16.3441 7.8236 16.3458C7.82176 16.3475 7.8209 16.3483 7.82092 16.3482C7.82094 16.3482 7.82198 16.3473 7.82395 16.3456C7.82592 16.3439 7.82893 16.3413 7.83291 16.338C7.84086 16.3314 7.85292 16.3216 7.86866 16.3098C7.88455 16.2979 7.90362 16.2843 7.92564 16.2699C7.94776 16.2553 7.97131 16.2408 7.99605 16.2268L9.96684 19.7076C10.376 19.476 10.6864 19.1421 10.8059 19.0225L7.9775 16.1941ZM8.94764 20.0746C9.11169 20.0336 9.55771 19.9393 9.96685 19.7076L7.99605 16.2268C8.02079 16.2128 8.0453 16.2001 8.06917 16.1886C8.09292 16.1772 8.11438 16.1678 8.13277 16.1603C8.15098 16.1529 8.16553 16.1475 8.17529 16.1441C8.18017 16.1424 8.18394 16.1412 8.18642 16.1404C8.1889 16.1395 8.19024 16.1391 8.19026 16.1391C8.19028 16.1391 8.18918 16.1395 8.18677 16.1402C8.18435 16.1409 8.18084 16.1419 8.17606 16.1432C8.16625 16.1459 8.15278 16.1496 8.13414 16.1544C8.11548 16.1593 8.09368 16.1649 8.0671 16.1716C8.04034 16.1784 8.0114 16.1856 7.97751 16.1941L8.94764 20.0746ZM15.1716 9C15.3435 9.17192 15.4698 9.29842 15.5738 9.40785C15.6786 9.518 15.7263 9.57518 15.7457 9.60073C15.7644 9.62524 15.7226 9.57638 15.6774 9.46782C15.6254 9.34332 15.5858 9.18102 15.5858 9H19.5858C19.5858 8.17978 19.2282 7.57075 18.9258 7.1744C18.6586 6.82421 18.2934 6.46493 18 6.17157L15.1716 9ZM18 11.8284L18 11.8284L15.1716 8.99999L15.1716 9L18 11.8284ZM18 11.8284C18.2934 11.5351 18.6586 11.1758 18.9258 10.8256C19.2282 10.4292 19.5858 9.82022 19.5858 9H15.5858C15.5858 8.81898 15.6254 8.65668 15.6774 8.53218C15.7226 8.42362 15.7644 8.37476 15.7457 8.39927C15.7263 8.42482 15.6786 8.482 15.5738 8.59215C15.4698 8.70157 15.3435 8.82807 15.1716 9L18 11.8284ZM15 8.82843C15.1719 8.6565 15.2984 8.53019 15.4078 8.42615C15.518 8.32142 15.5752 8.27375 15.6007 8.25426C15.6252 8.23555 15.5764 8.27736 15.4678 8.32264C15.3433 8.37455 15.181 8.41421 15 8.41421V4.41421C14.1798 4.41421 13.5707 4.77177 13.1744 5.07417C12.8242 5.34136 12.4649 5.70664 12.1716 6L15 8.82843ZM17.8284 6C17.5351 5.70665 17.1758 5.34136 16.8256 5.07417C16.4293 4.77177 15.8202 4.41421 15 4.41421V8.41421C14.819 8.41421 14.6567 8.37455 14.5322 8.32264C14.4236 8.27736 14.3748 8.23555 14.3993 8.25426C14.4248 8.27375 14.482 8.32142 14.5922 8.42615C14.7016 8.53019 14.8281 8.6565 15 8.82843L17.8284 6ZM4.9775 13.1941C4.85793 13.3136 4.52401 13.624 4.29236 14.0332L7.77316 16.0039C7.75915 16.0287 7.7447 16.0522 7.73014 16.0744C7.71565 16.0964 7.70207 16.1155 7.69016 16.1313C7.67837 16.1471 7.66863 16.1591 7.66202 16.1671C7.65871 16.1711 7.65613 16.1741 7.65442 16.1761C7.65271 16.178 7.65178 16.1791 7.65176 16.1791C7.65174 16.1791 7.65252 16.1782 7.65422 16.1764C7.65593 16.1745 7.65842 16.1719 7.66184 16.1683C7.66884 16.1609 7.67852 16.1508 7.692 16.1371C7.7055 16.1233 7.72132 16.1073 7.74066 16.0879C7.76013 16.0683 7.78122 16.0472 7.80593 16.0225L4.9775 13.1941ZM7.80593 16.0225C7.8144 15.9886 7.82164 15.9597 7.82839 15.9329C7.8351 15.9063 7.84068 15.8845 7.84556 15.8659C7.85043 15.8472 7.85407 15.8337 7.8568 15.8239C7.85813 15.8192 7.85914 15.8157 7.85984 15.8132C7.86054 15.8108 7.86088 15.8097 7.86088 15.8097C7.86087 15.8098 7.86046 15.8111 7.85965 15.8136C7.85884 15.8161 7.85758 15.8198 7.85588 15.8247C7.85246 15.8345 7.84713 15.849 7.8397 15.8672C7.8322 15.8856 7.82284 15.9071 7.81141 15.9308C7.79993 15.9547 7.78717 15.9792 7.77316 16.0039L4.29236 14.0332C4.06071 14.4423 3.96637 14.8883 3.92536 15.0524L7.80593 16.0225Z"
                                                    fill="#C4C4C4"
                                                    mask="url(#path-1-outside-1_2165_508)"
                                                />
                                                <path
                                                    d="M12.5 7.5L15.5 5.5L18.5 8.5L16.5 11.5L12.5 7.5Z"
                                                    fill="#C4C4C4"
                                                />
                                            </svg>
                                            Edit Post
                                        </button>
                                        <button
                                        onClick={togglePopupDelete}
                                            href="#"
                                            className="flex items-center w-full gap-2 px-4 py-2 text-sm hover:bg-[#222222]"
                                        >
                                            <svg
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M10 15L10 12"
                                                    stroke="#D53C3C"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                />
                                                <path
                                                    d="M14 15L14 12"
                                                    stroke="#D53C3C"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                />
                                                <path
                                                    d="M3 7H21V7C20.0681 7 19.6022 7 19.2346 7.15224C18.7446 7.35523 18.3552 7.74458 18.1522 8.23463C18 8.60218 18 9.06812 18 10V16C18 17.8856 18 18.8284 17.4142 19.4142C16.8284 20 15.8856 20 14 20H10C8.11438 20 7.17157 20 6.58579 19.4142C6 18.8284 6 17.8856 6 16V10C6 9.06812 6 8.60218 5.84776 8.23463C5.64477 7.74458 5.25542 7.35523 4.76537 7.15224C4.39782 7 3.93188 7 3 7V7Z"
                                                    stroke="#D53C3C"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                />
                                                <path
                                                    d="M10.0681 3.37059C10.1821 3.26427 10.4332 3.17033 10.7825 3.10332C11.1318 3.03632 11.5597 3 12 3C12.4403 3 12.8682 3.03632 13.2175 3.10332C13.5668 3.17033 13.8179 3.26427 13.9319 3.37059"
                                                    stroke="#D53C3C"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                ) : (
                                    <div>
                                        <button
                                            href="#"
                                            className="flex w-full gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <svg
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M19 2H6.27001C5.5682 2.00023 4.88868 2.24651 4.34969 2.69598C3.81069 3.14544 3.44633 3.76965 3.32001 4.46L2.05001 11.46C1.97088 11.8924 1.98775 12.337 2.09944 12.7622C2.21113 13.1874 2.41491 13.5828 2.69634 13.9206C2.97778 14.2583 3.33 14.53 3.72809 14.7166C4.12617 14.9031 4.56039 14.9999 5.00001 15H9.56001L9.00001 16.43C8.76707 17.0561 8.6895 17.7294 8.77394 18.3921C8.85838 19.0548 9.10232 19.6871 9.48482 20.2348C9.86732 20.7825 10.377 21.2292 10.9701 21.5367C11.5632 21.8441 12.222 22.0031 12.89 22C13.0824 21.9996 13.2705 21.9437 13.4319 21.8391C13.5933 21.7344 13.7211 21.5854 13.8 21.41L16.65 15H19C19.7957 15 20.5587 14.6839 21.1213 14.1213C21.6839 13.5587 22 12.7956 22 12V5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7957 2 19 2ZM15 13.79L12.28 19.91C12.0017 19.8258 11.7436 19.6855 11.5215 19.4978C11.2995 19.31 11.1183 19.0788 10.989 18.8183C10.8597 18.5579 10.7851 18.2737 10.7698 17.9834C10.7545 17.693 10.7988 17.4026 10.9 17.13L11.43 15.7C11.5429 15.3977 11.5811 15.0727 11.5411 14.7525C11.5012 14.4323 11.3844 14.1265 11.2007 13.8613C11.017 13.596 10.7718 13.3791 10.4861 13.2292C10.2004 13.0792 9.88267 13.0006 9.56001 13H5.00001C4.8531 13.0002 4.70794 12.9681 4.57485 12.9059C4.44177 12.8437 4.32403 12.7529 4.23001 12.64C4.13367 12.5287 4.06311 12.3975 4.02335 12.2557C3.98359 12.114 3.97562 11.9652 4.00001 11.82L5.27001 4.82C5.3126 4.58704 5.43649 4.37676 5.61962 4.2266C5.80274 4.07644 6.03322 3.99614 6.27001 4H15V13.79ZM20 12C20 12.2652 19.8947 12.5196 19.7071 12.7071C19.5196 12.8946 19.2652 13 19 13H17V4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8947 4.48043 20 4.73478 20 5V12Z"
                                                    fill="#FF0000"
                                                />
                                            </svg>
                                            Not Interest
                                        </button>
                                        <button
                                            href="#"
                                            className="flex w-full gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <svg
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M19.9912 2.00201C19.8599 2.00194 19.7298 2.02775 19.6084 2.07798C19.4871 2.12821 19.3768 2.20187 19.2839 2.29474C19.1911 2.38761 19.1174 2.49788 19.0672 2.61924C19.017 2.7406 18.9911 2.87067 18.9912 3.00201V3.63873C18.1478 4.68444 17.0819 5.52893 15.871 6.11073C14.66 6.69254 13.3346 6.99702 11.9912 7.00201H5.99121C5.19583 7.00288 4.43327 7.31923 3.87085 7.88165C3.30843 8.44407 2.99208 9.20663 2.99121 10.002V12.002C2.99208 12.7974 3.30843 13.56 3.87085 14.1224C4.43327 14.6848 5.19583 15.0011 5.99121 15.002H6.475L4.07227 20.6084C4.00698 20.7605 3.98047 20.9264 3.99512 21.0912C4.00978 21.256 4.06514 21.4147 4.15624 21.5528C4.24734 21.691 4.37133 21.8043 4.51706 21.8827C4.6628 21.9611 4.82572 22.0021 4.99121 22.002H8.99121C9.18696 22.0021 9.37843 21.9447 9.54182 21.8369C9.7052 21.7291 9.83329 21.5756 9.91016 21.3956L12.6339 15.04C13.8646 15.1304 15.0636 15.472 16.157 16.0439C17.2505 16.6158 18.215 17.4058 18.9912 18.3651V19.002C18.9912 19.2672 19.0966 19.5216 19.2841 19.7091C19.4716 19.8967 19.726 20.002 19.9912 20.002C20.2564 20.002 20.5108 19.8967 20.6983 19.7091C20.8859 19.5216 20.9912 19.2672 20.9912 19.002V3.00201C20.9913 2.87067 20.9655 2.7406 20.9152 2.61924C20.865 2.49788 20.7914 2.38761 20.6985 2.29474C20.6056 2.20186 20.4953 2.12821 20.374 2.07798C20.2526 2.02775 20.1226 2.00194 19.9912 2.00201ZM5.99121 13.002C5.72605 13.0018 5.4718 12.8964 5.2843 12.7089C5.0968 12.5214 4.99139 12.2672 4.99121 12.002V10.002C4.99139 9.73685 5.09681 9.4826 5.2843 9.29511C5.4718 9.10761 5.72605 9.00219 5.99121 9.00201H6.99121V13.002H5.99121ZM8.33203 20.002H6.50781L8.65039 15.002H10.4746L8.33203 20.002ZM18.9912 15.5238C17.0195 13.8994 14.5459 13.0083 11.9912 13.002H8.99121V9.00196H11.9912C14.5459 8.99543 17.0195 8.10412 18.9912 6.47962V15.5238Z"
                                                    fill="#FF0000"
                                                />
                                            </svg>
                                            Report
                                        </button>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                    <img
                        src={"/storage/" + post.body}
                        alt=""
                        className="w-fit rounded-lg overflow-hidden"
                    />
                    <div className="flex gap-1 items-center">
                        <div className="cursor-pointer hover:bg-gray-700 rounded-full w-fit p-2 h-fit">
                            {post.like.some(
                                (like) => like.user_id === user.id
                            ) ? (
                                <button
                                    onClick={() => handleunlike(post.id)}
                                    disabled={disabled}
                                >
                                    <svg
                                        width="25"
                                        height="25"
                                        viewBox="0 0 29 28"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M4.13903 16.0803L14.7761 27.2405C15.1702 27.6539 15.8298 27.6539 16.2239 27.2405L26.861 16.0803C29.713 13.088 29.713 8.23653 26.861 5.24423C24.0089 2.25192 19.3849 2.25192 16.5328 5.24423L16.2239 5.56837C15.8298 5.98178 15.1702 5.98178 14.7761 5.56837L14.4672 5.24423C11.6151 2.25193 6.99107 2.25193 4.13903 5.24423C1.28699 8.23653 1.28699 13.088 4.13903 16.0803Z"
                                            fill="#FF3040"
                                        />
                                    </svg>
                                </button>
                            ) : (
                                <button
                                    onClick={() => handlelike(post.id)}
                                    disabled={disabled}
                                >
                                    <svg
                                        width="25"
                                        height="25"
                                        viewBox="0 0 29 27"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M3.13903 14.0803L13.7761 25.2405C14.1702 25.6539 14.8298 25.6539 15.2239 25.2405L25.861 14.0803C28.713 11.088 28.713 6.23653 25.861 3.24423C23.0089 0.251924 18.3849 0.251924 15.5328 3.24423L15.2239 3.56837C14.8298 3.98178 14.1702 3.98178 13.7761 3.56837L13.4672 3.24423C10.6151 0.251925 5.99107 0.251925 3.13903 3.24423C0.28699 6.23653 0.28699 11.088 3.13903 14.0803Z"
                                            stroke="white"
                                            strokeWidth="2"
                                        />
                                    </svg>
                                </button>
                            )}
                        </div>
                        <button
                            onClick={() => formfocus()}
                            className="cursor-pointer flex items-center justify-center hover:bg-gray-700 rounded-full w-fit p-2 h-fit"
                        >
                            <svg
                                width="25"
                                height="25"
                                viewBox="0 0 31 31"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <mask
                                    id="path-1-outside-1_236_149"
                                    maskUnits="userSpaceOnUse"
                                    x="1.99414"
                                    y="2"
                                    width="29"
                                    height="29"
                                    fill="black"
                                >
                                    <rect
                                        fill="white"
                                        x="1.99414"
                                        y="2"
                                        width="29"
                                        height="29"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M25.8272 24.8154C27.7971 22.6061 28.9941 19.6929 28.9941 16.5C28.9941 9.59644 23.3977 4 16.4941 4C9.59058 4 3.99414 9.59644 3.99414 16.5C3.99414 23.4036 9.59058 29 16.4941 29C18.8689 29 21.0889 28.3378 22.9797 27.188L26.498 27.9427L25.8272 24.8154Z"
                                    />
                                </mask>
                                <path
                                    d="M25.8272 24.8154L24.3344 23.4845L23.6588 24.2423L23.8717 25.2349L25.8272 24.8154ZM22.9797 27.188L23.3992 25.2325L22.6208 25.0655L21.9405 25.4791L22.9797 27.188ZM26.498 27.9427L26.0786 29.8982L29.1021 30.5468L28.4536 27.5232L26.498 27.9427ZM26.9941 16.5C26.9941 19.1833 25.9902 21.6273 24.3344 23.4845L27.32 26.1464C29.6039 23.5849 30.9941 20.2024 30.9941 16.5H26.9941ZM16.4941 6C22.2931 6 26.9941 10.701 26.9941 16.5H30.9941C30.9941 8.49187 24.5023 2 16.4941 2V6ZM5.99414 16.5C5.99414 10.701 10.6952 6 16.4941 6V2C8.48601 2 1.99414 8.49187 1.99414 16.5H5.99414ZM16.4941 27C10.6952 27 5.99414 22.299 5.99414 16.5H1.99414C1.99414 24.5081 8.48601 31 16.4941 31V27ZM21.9405 25.4791C20.354 26.4439 18.4921 27 16.4941 27V31C19.2456 31 21.8238 30.2317 24.0189 28.8968L21.9405 25.4791ZM22.5602 29.1435L26.0786 29.8982L26.9175 25.9872L23.3992 25.2325L22.5602 29.1435ZM28.4536 27.5232L27.7827 24.396L23.8717 25.2349L24.5425 28.3622L28.4536 27.5232Z"
                                    fill="white"
                                    mask="url(#path-1-outside-1_236_149)"
                                />
                            </svg>
                        </button>

                        <div className="cursor-pointer hover:bg-gray-700 rounded-full w-fit p-2 h-fit">
                            <svg
                                width="25"
                                height="27"
                                viewBox="0 0 29 27"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M12.7222 14.3333L15.2281 25.6097C15.3261 26.0508 15.9125 26.1459 16.1449 25.7585L27.5457 6.75725C27.7456 6.42399 27.5056 6 27.1169 6H4.35163C3.88743 6 3.67378 6.57753 4.02623 6.87963L12.7222 14.3333ZM12.7222 14.3333L26.6111 6.69444"
                                    stroke="white"
                                    stroke-width="2"
                                />
                            </svg>
                        </div>
                    </div>
                    <p className="text-white text-sm text-opacity-50">
                        {post.comment.length} balasan
                    </p>
                </div>
            </div>
            {loading ? (
                <div className="flex items-center justify-center">
                    <span class="loader"></span>
                </div>
            ) : (
                <form
                    onSubmit={handlecomment}
                    class="w-full py-4 border-t border-gray-600 relative flex items-center gap-4"
                >
                    <img
                        src={`/storage/${user.image}`}
                        alt=""
                        className="w-12 h-12 object-cover rounded-full"
                    />
                    <input type="hidden" name="post_id" value={id} />
                    <input
                        id="comment-input"
                        type="text"
                        autoComplete="off"
                        spellCheck="false"
                        placeholder="add a comment"
                        value={Body}
                        onChange={(e) => setBody(e.target.value)}
                        name="body"
                        class="placeholder-text-white w-full h-full bg-transparent border-b border-white border-opacity-50 focus:border-opacity-100 focus:outline-none"
                    />

                    <button
                        type="submit"
                        className="hover:bg-blue-600 rounded-full p-2 flex items-center justify-center"
                    >
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M20.34 9.32L6.34 2.32C5.78749 2.04501 5.16362 1.94711 4.55344 2.03965C3.94326 2.13219 3.37646 2.41067 2.93033 2.83711C2.48421 3.26356 2.18046 3.81722 2.0605 4.42261C1.94054 5.028 2.0102 5.65565 2.26 6.22L4.66 11.59C4.71446 11.7198 4.74251 11.8592 4.74251 12C4.74251 12.1408 4.71446 12.2802 4.66 12.41L2.26 17.78C2.0567 18.2367 1.97076 18.737 2.00998 19.2354C2.0492 19.7337 2.21235 20.2144 2.48459 20.6337C2.75682 21.053 3.12953 21.3976 3.56883 21.6362C4.00812 21.8748 4.50009 21.9999 5 22C5.46823 21.9953 5.92949 21.886 6.35 21.68L20.35 14.68C20.8466 14.4302 21.264 14.0473 21.5557 13.5741C21.8474 13.1009 22.0018 12.5559 22.0018 12C22.0018 11.4441 21.8474 10.8991 21.5557 10.4259C21.264 9.95269 20.8466 9.56981 20.35 9.32H20.34ZM19.45 12.89L5.45 19.89C5.26617 19.9783 5.05973 20.0082 4.85839 19.9758C4.65705 19.9435 4.47041 19.8503 4.32352 19.7089C4.17662 19.5674 4.07648 19.3844 4.03653 19.1844C3.99658 18.9844 4.01873 18.777 4.1 18.59L6.49 13.22C6.52094 13.1483 6.54766 13.0748 6.57 13H13.46C13.7252 13 13.9796 12.8946 14.1671 12.7071C14.3546 12.5196 14.46 12.2652 14.46 12C14.46 11.7348 14.3546 11.4804 14.1671 11.2929C13.9796 11.1054 13.7252 11 13.46 11H6.57C6.54766 10.9252 6.52094 10.8517 6.49 10.78L4.1 5.41C4.01873 5.22296 3.99658 5.01555 4.03653 4.81557C4.07648 4.61559 4.17662 4.4326 4.32352 4.29115C4.47041 4.14969 4.65705 4.05653 4.85839 4.02415C5.05973 3.99177 5.26617 4.02173 5.45 4.11L19.45 11.11C19.6138 11.1939 19.7513 11.3214 19.8473 11.4784C19.9433 11.6355 19.994 11.816 19.994 12C19.994 12.184 19.9433 12.3645 19.8473 12.5216C19.7513 12.6786 19.6138 12.8061 19.45 12.89Z"
                                fill="white"
                            />
                        </svg>
                    </button>
                </form>
            )}
            {post.comment.map((comment, index) => (
                <div key={index} className="flex gap-4 py-4 comment-container">
                    <img
                        src={`/storage/${comment.user.image}`}
                        alt=""
                        className="w-12 h-12 object-cover rounded-full"
                    />
                    <div className="w-full">
                        <div className="flex items-center justify-between">
                            <div className="flex items-center gap-2">
                                <p className="font-bold">{comment.user.name}</p>
                                <p className="text-[#E1E3E4] text-sm">
                                    {moment.utc(comment.created_at).fromNow()}
                                </p>
                            </div>
                        </div>
                        <p className="break-all">{comment.body}</p>
                        <button
                            className="text-sm font-medium px-3 py-1 rounded-lg hover:bg-opacity-20 hover:bg-white"
                            onClick={() => toggleReply(comment.id)}
                        >
                            reply
                        </button>

                        <form
                            onSubmit={(e) => handlereply(e, comment.id)}
                            class="w-full hidden py-2 relative flex items-center gap-4"
                            id={`replyComment-${comment.id}`}
                        >
                            <img
                                src={`/storage/${user.image}`}
                                alt=""
                                className="w-12 h-12 object-cover rounded-full"
                            />
                            <input
                                id={`comment-${comment.id}`}
                                type="text"
                                autoComplete="off"
                                spellCheck="false"
                                value={reply}
                                placeholder={`Reply to ${comment.user.name}`}
                                onChange={(e) => setreply(e.target.value)}
                                name="body"
                                class="placeholder-text-white w-full h-full bg-transparent border-b border-white border-opacity-50 focus:border-opacity-100 focus:outline-none"
                            />

                            <div className="flex items-center justify-center gap-2">
                                <button
                                    type="submit"
                                    className="hover:bg-blue-600 rounded-full p-2 flex items-center justify-center"
                                >
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M20.34 9.32L6.34 2.32C5.78749 2.04501 5.16362 1.94711 4.55344 2.03965C3.94326 2.13219 3.37646 2.41067 2.93033 2.83711C2.48421 3.26356 2.18046 3.81722 2.0605 4.42261C1.94054 5.028 2.0102 5.65565 2.26 6.22L4.66 11.59C4.71446 11.7198 4.74251 11.8592 4.74251 12C4.74251 12.1408 4.71446 12.2802 4.66 12.41L2.26 17.78C2.0567 18.2367 1.97076 18.737 2.00998 19.2354C2.0492 19.7337 2.21235 20.2144 2.48459 20.6337C2.75682 21.053 3.12953 21.3976 3.56883 21.6362C4.00812 21.8748 4.50009 21.9999 5 22C5.46823 21.9953 5.92949 21.886 6.35 21.68L20.35 14.68C20.8466 14.4302 21.264 14.0473 21.5557 13.5741C21.8474 13.1009 22.0018 12.5559 22.0018 12C22.0018 11.4441 21.8474 10.8991 21.5557 10.4259C21.264 9.95269 20.8466 9.56981 20.35 9.32H20.34ZM19.45 12.89L5.45 19.89C5.26617 19.9783 5.05973 20.0082 4.85839 19.9758C4.65705 19.9435 4.47041 19.8503 4.32352 19.7089C4.17662 19.5674 4.07648 19.3844 4.03653 19.1844C3.99658 18.9844 4.01873 18.777 4.1 18.59L6.49 13.22C6.52094 13.1483 6.54766 13.0748 6.57 13H13.46C13.7252 13 13.9796 12.8946 14.1671 12.7071C14.3546 12.5196 14.46 12.2652 14.46 12C14.46 11.7348 14.3546 11.4804 14.1671 11.2929C13.9796 11.1054 13.7252 11 13.46 11H6.57C6.54766 10.9252 6.52094 10.8517 6.49 10.78L4.1 5.41C4.01873 5.22296 3.99658 5.01555 4.03653 4.81557C4.07648 4.61559 4.17662 4.4326 4.32352 4.29115C4.47041 4.14969 4.65705 4.05653 4.85839 4.02415C5.05973 3.99177 5.26617 4.02173 5.45 4.11L19.45 11.11C19.6138 11.1939 19.7513 11.3214 19.8473 11.4784C19.9433 11.6355 19.994 11.816 19.994 12C19.994 12.184 19.9433 12.3645 19.8473 12.5216C19.7513 12.6786 19.6138 12.8061 19.45 12.89Z"
                                            fill="white"
                                        />
                                    </svg>
                                </button>
                                <button
                                    onClick={() => toggleReply(comment.id)}
                                    className="p-2 flex items-center justify-center rounded-full hover:bg-white hover:bg-opacity-30"
                                >
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12ZM12 13.4142L8.70711 16.7071L7.29289 15.2929L10.5858 12L7.29289 8.70711L8.70711 7.29289L12 10.5858L15.2929 7.29289L16.7071 8.70711L13.4142 12L16.7071 15.2929L15.2929 16.7071L12 13.4142Z"
                                            fill="#B2071D"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </form>
                        {comment.reply.length > 0 && (
                            <button
                                onClick={() => toggleSeeReply(comment.id)}
                                className="flex items-center py-2 px-2 rounded-lg hover:bg-[#263850]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    fill="currentColor"
                                    class="bi bi-arrow-down-short"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4"
                                    />
                                </svg>
                                <p className="text-[#3DA0F5] text-base">
                                    {comment.reply.length} Balasan
                                </p>
                            </button>
                        )}
                        <div
                            className="hidden"
                            id={`seeReplyComment-${comment.id}`}
                        >
                            {comment.reply.map((reply) => (
                                <div
                                    key={reply.id}
                                    className="flex gap-4 py-2 w-fit rounded-lg"
                                >
                                    <img
                                        src={`/storage/${reply.user.image}`}
                                        alt=""
                                        className="w-12 h-12 object-cover rounded-full"
                                    />
                                    <div>
                                        <div className="flex gap-2 items-center">
                                            <h1 className="font-semibold">
                                                {reply.user.name}
                                            </h1>
                                            <p className="text-xs">
                                                {moment
                                                    .utc(reply.created_at)
                                                    .fromNow()}
                                            </p>
                                        </div>
                                        <p>{reply.body}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                    <div>
                        <button
                            className="flex items-center justify-center w-10 h-10 rounded-full hover:bg-white hover:bg-opacity-10 cursor-pointer"
                            onClick={() => dropdowncomment(comment.id)}
                        >
                            <svg
                                width="18"
                                height="18"
                                viewBox="0 0 68 17"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fillRule="evenodd"
                                    clipRule="evenodd"
                                    d="M8.94595 16.9279C13.5384 16.9279 17.2613 13.205 17.2613 8.61263C17.2613 4.0202 13.5384 0.29731 8.94595 0.29731C4.35352 0.29731 0.63063 4.0202 0.63063 8.61263C0.63063 13.205 4.35352 16.9279 8.94595 16.9279ZM42.2072 8.61263C42.2072 13.205 38.4843 16.9279 33.8919 16.9279C29.2995 16.9279 25.5766 13.205 25.5766 8.61263C25.5766 4.0202 29.2995 0.29731 33.8919 0.29731C38.4843 0.29731 42.2072 4.0202 42.2072 8.61263ZM67.1532 8.61263C67.1532 13.205 63.4303 16.9279 58.8378 16.9279C54.2454 16.9279 50.5225 13.205 50.5225 8.61263C50.5225 4.0202 54.2454 0.29731 58.8378 0.29731C63.4303 0.29731 67.1532 4.0202 67.1532 8.61263Z"
                                    fill="white"
                                />
                            </svg>
                        </button>
                        <div
                            className="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden hidden"
                            id={`dropdown-comment-${comment.id}`}
                        >
                            <button
                                href="#"
                                className="flex w-full gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            >
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M19 2H6.27001C5.5682 2.00023 4.88868 2.24651 4.34969 2.69598C3.81069 3.14544 3.44633 3.76965 3.32001 4.46L2.05001 11.46C1.97088 11.8924 1.98775 12.337 2.09944 12.7622C2.21113 13.1874 2.41491 13.5828 2.69634 13.9206C2.97778 14.2583 3.33 14.53 3.72809 14.7166C4.12617 14.9031 4.56039 14.9999 5.00001 15H9.56001L9.00001 16.43C8.76707 17.0561 8.6895 17.7294 8.77394 18.3921C8.85838 19.0548 9.10232 19.6871 9.48482 20.2348C9.86732 20.7825 10.377 21.2292 10.9701 21.5367C11.5632 21.8441 12.222 22.0031 12.89 22C13.0824 21.9996 13.2705 21.9437 13.4319 21.8391C13.5933 21.7344 13.7211 21.5854 13.8 21.41L16.65 15H19C19.7957 15 20.5587 14.6839 21.1213 14.1213C21.6839 13.5587 22 12.7956 22 12V5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7957 2 19 2ZM15 13.79L12.28 19.91C12.0017 19.8258 11.7436 19.6855 11.5215 19.4978C11.2995 19.31 11.1183 19.0788 10.989 18.8183C10.8597 18.5579 10.7851 18.2737 10.7698 17.9834C10.7545 17.693 10.7988 17.4026 10.9 17.13L11.43 15.7C11.5429 15.3977 11.5811 15.0727 11.5411 14.7525C11.5012 14.4323 11.3844 14.1265 11.2007 13.8613C11.017 13.596 10.7718 13.3791 10.4861 13.2292C10.2004 13.0792 9.88267 13.0006 9.56001 13H5.00001C4.8531 13.0002 4.70794 12.9681 4.57485 12.9059C4.44177 12.8437 4.32403 12.7529 4.23001 12.64C4.13367 12.5287 4.06311 12.3975 4.02335 12.2557C3.98359 12.114 3.97562 11.9652 4.00001 11.82L5.27001 4.82C5.3126 4.58704 5.43649 4.37676 5.61962 4.2266C5.80274 4.07644 6.03322 3.99614 6.27001 4H15V13.79ZM20 12C20 12.2652 19.8947 12.5196 19.7071 12.7071C19.5196 12.8946 19.2652 13 19 13H17V4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8947 4.48043 20 4.73478 20 5V12Z"
                                        fill="#FF0000"
                                    />
                                </svg>
                                Not Interest
                            </button>
                            <button
                                href="#"
                                className="flex w-full gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            >
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M19.9912 2.00201C19.8599 2.00194 19.7298 2.02775 19.6084 2.07798C19.4871 2.12821 19.3768 2.20187 19.2839 2.29474C19.1911 2.38761 19.1174 2.49788 19.0672 2.61924C19.017 2.7406 18.9911 2.87067 18.9912 3.00201V3.63873C18.1478 4.68444 17.0819 5.52893 15.871 6.11073C14.66 6.69254 13.3346 6.99702 11.9912 7.00201H5.99121C5.19583 7.00288 4.43327 7.31923 3.87085 7.88165C3.30843 8.44407 2.99208 9.20663 2.99121 10.002V12.002C2.99208 12.7974 3.30843 13.56 3.87085 14.1224C4.43327 14.6848 5.19583 15.0011 5.99121 15.002H6.475L4.07227 20.6084C4.00698 20.7605 3.98047 20.9264 3.99512 21.0912C4.00978 21.256 4.06514 21.4147 4.15624 21.5528C4.24734 21.691 4.37133 21.8043 4.51706 21.8827C4.6628 21.9611 4.82572 22.0021 4.99121 22.002H8.99121C9.18696 22.0021 9.37843 21.9447 9.54182 21.8369C9.7052 21.7291 9.83329 21.5756 9.91016 21.3956L12.6339 15.04C13.8646 15.1304 15.0636 15.472 16.157 16.0439C17.2505 16.6158 18.215 17.4058 18.9912 18.3651V19.002C18.9912 19.2672 19.0966 19.5216 19.2841 19.7091C19.4716 19.8967 19.726 20.002 19.9912 20.002C20.2564 20.002 20.5108 19.8967 20.6983 19.7091C20.8859 19.5216 20.9912 19.2672 20.9912 19.002V3.00201C20.9913 2.87067 20.9655 2.7406 20.9152 2.61924C20.865 2.49788 20.7914 2.38761 20.6985 2.29474C20.6056 2.20186 20.4953 2.12821 20.374 2.07798C20.2526 2.02775 20.1226 2.00194 19.9912 2.00201ZM5.99121 13.002C5.72605 13.0018 5.4718 12.8964 5.2843 12.7089C5.0968 12.5214 4.99139 12.2672 4.99121 12.002V10.002C4.99139 9.73685 5.09681 9.4826 5.2843 9.29511C5.4718 9.10761 5.72605 9.00219 5.99121 9.00201H6.99121V13.002H5.99121ZM8.33203 20.002H6.50781L8.65039 15.002H10.4746L8.33203 20.002ZM18.9912 15.5238C17.0195 13.8994 14.5459 13.0083 11.9912 13.002H8.99121V9.00196H11.9912C14.5459 8.99543 17.0195 8.10412 18.9912 6.47962V15.5238Z"
                                        fill="#FF0000"
                                    />
                                </svg>
                                Report
                            </button>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
}
