import { Inertia } from "@inertiajs/inertia";
import React from "react";
import { useState } from "react";

export default function detailPost({ post, user }) {
    
    const [disabled, setdisabled] = useState(false);
    const [id, setid] = useState(post.id);
    const [Body, setBody] = useState("");
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
            body :Body,
            post_id : id
        };
        Inertia.post(`/comment`, formData ,{preserveScroll: true , onFinish: () => setBody("")});
    };
    return (
        <div>
            <div className="flex py-4 border-y border-gray-600 gap-2 relative">
                <div>
                    <div className="mb-4 flex gap-2">
                        <img
                            src={"/storage/" + post.user.image}
                            alt=""
                            className="w-12 h-12 object-cover rounded-full"
                        />
                        <div>
                            <h1 className="font-semibold text-base text-[#DCDEE0]">
                                {post.user.name}
                            </h1>
                            <p className="text-[#E1E3E4]  text-sm">
                                {post.title}
                            </p>
                        </div>
                    </div>
                    <img
                        src={"/storage/" + post.body}
                        alt=""
                        className="w-full rounded-lg overflow-hidden"
                    />
                    <div className="flex mt-4 mb-1 gap-1 items-center">
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
                        <div className="cursor-pointer flex items-center justify-center hover:bg-gray-700 rounded-full w-fit p-2 h-fit">
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
                        </div>

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

                    <p>{post.comment.length} balasan</p>
                </div>
                <div className="absolute top-0 flex items-center justify-center right-0 w-10 h-10 rounded-full hover:bg-white hover:bg-opacity-10">
                    <svg
                        width="18"
                        height="18"
                        viewBox="0 0 68 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M8.94595 16.9279C13.5384 16.9279 17.2613 13.205 17.2613 8.61263C17.2613 4.0202 13.5384 0.29731 8.94595 0.29731C4.35352 0.29731 0.63063 4.0202 0.63063 8.61263C0.63063 13.205 4.35352 16.9279 8.94595 16.9279ZM42.2072 8.61263C42.2072 13.205 38.4843 16.9279 33.8919 16.9279C29.2995 16.9279 25.5766 13.205 25.5766 8.61263C25.5766 4.0202 29.2995 0.29731 33.8919 0.29731C38.4843 0.29731 42.2072 4.0202 42.2072 8.61263ZM67.1532 8.61263C67.1532 13.205 63.4303 16.9279 58.8378 16.9279C54.2454 16.9279 50.5225 13.205 50.5225 8.61263C50.5225 4.0202 54.2454 0.29731 58.8378 0.29731C63.4303 0.29731 67.1532 4.0202 67.1532 8.61263Z"
                            fill="white"
                        />
                    </svg>
                </div>
            </div>
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
            {post.comment.map((comment, index) => (
                <div
                    key={index}
                    className="flex gap-4 relative py-4 border-b border-gray-600"
                >
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
                                    {comment.created_at}
                                </p>
                            </div>
                        </div>
                        <p>{comment.body}</p>
                    </div>
                    <div className="absolute top-0 flex items-center justify-center right-0 w-10 h-10 rounded-full hover:bg-white hover:bg-opacity-10">
                        <svg
                            width="18"
                            height="18"
                            viewBox="0 0 68 17"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M8.94595 16.9279C13.5384 16.9279 17.2613 13.205 17.2613 8.61263C17.2613 4.0202 13.5384 0.29731 8.94595 0.29731C4.35352 0.29731 0.63063 4.0202 0.63063 8.61263C0.63063 13.205 4.35352 16.9279 8.94595 16.9279ZM42.2072 8.61263C42.2072 13.205 38.4843 16.9279 33.8919 16.9279C29.2995 16.9279 25.5766 13.205 25.5766 8.61263C25.5766 4.0202 29.2995 0.29731 33.8919 0.29731C38.4843 0.29731 42.2072 4.0202 42.2072 8.61263ZM67.1532 8.61263C67.1532 13.205 63.4303 16.9279 58.8378 16.9279C54.2454 16.9279 50.5225 13.205 50.5225 8.61263C50.5225 4.0202 54.2454 0.29731 58.8378 0.29731C63.4303 0.29731 67.1532 4.0202 67.1532 8.61263Z"
                                fill="white"
                            />
                        </svg>
                    </div>
                </div>
            ))}
        </div>
    );
}
